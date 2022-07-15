<?php

namespace App\Controller;

use App\Entity\ColorName;
use App\Entity\Deck;
use App\Entity\Game;
use App\Entity\ValueName;
use App\Form\GameType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game_index")
     */
    public function gameIndex(): Response // show mixed full deck 
    {
        $deck = new Deck();

        return $this->render('game/index.html.twig', [
            "cards" => $deck->getMixedDeck(),
        ]);
    }
    
    /**
     * @Route("/", name="game_init", methods={"GET","POST"})
     */
    public function gameInit(Request $request): Response
    {   
       
       
        $session = $request->getSession();  
         
        $game = $session->get('game')===null ? new Game() : $session->get('game');
        $session->set('game',$game);
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            //new number of cards to keep
            $game->setNum($form->getData('num')->getNum());
            //new set of cards
            $game->setCardsTemplate($form->getData('cardsTemplate')->getCardsTemplate());
            //new prefered order of colors and values
            $deck = $game->getDeck();
            $deck->setMixedColors(explode(',',$form->get('preferedColors')->getData()));
            $deck->setMixedValues(explode(',',$form->get('preferedValues')->getData()));
            $game->setDeck($deck);
            //save it in session
            $session->set('game',$game);

            return $this->redirectToRoute('game_index_random');
        }

        return $this->render('game/init.html.twig',array(
            'form' => $form->createView(),
            ));
        
    }

    /**
     * @Route("/random/", name="game_index_random")
     */
    public function gameHand(Request $request): Response
    {
        
        $session = $request->getSession(); 
        $game=$session->get('game');
        $deck = $game->getDeck();
        $colors = $deck->getMixedColors(); 
        $values = $deck->getMixedValues(); 
        $cards = $deck->getFullDeck();
        $numberOfCards = $game->getNum();
        $orderedResult =  [];
        $unorderedResult =  [];
        $index = array_rand($cards,$numberOfCards); 
        if($numberOfCards>1){
            for ($i=0;$i < $numberOfCards ;$i++){   
                $orderedResult[$index[$i]] = $cards[$index[$i]];  
                unset($cards[$index[$i]]); 
            }
         }else{$orderedResult[0] = $cards[0];}

        $session->set('orderedResult', $orderedResult);
        foreach ($colors as $color){
            foreach ($values as $value){
                /** @var Card $card */
                foreach ($orderedResult as $card){
                    if ($card->getColor() == $color && $card->getValue() == $value){
                        array_push($unorderedResult,$card);
                    }
                } 
            }    
        }

        $session->set('unorderedResult', $unorderedResult);


        return $this->render('game/play.html.twig');
    }

    /**
     * @Route("/random_colors", name="game_random_colors")
     */
    public function randomColors(Request $request): Response
    {
        
        $session = $request->getSession(); 
        $game=$session->get('game');
        $deck = $game->getDeck();

        $colors = $deck->getMixedColors(); 
        $colors = $deck->random($colors);
        
        $deck->setMixedColors($colors);
        $game->setDeck($deck);

        $session->set('game', $game);


        return $this->redirectToRoute('game_init');
    }

    /**
     * @Route("/random_values", name="game_random_values")
     */
    public function randomValues(Request $request): Response
    {
        
        $session = $request->getSession(); 
        $game=$session->get('game');
        $deck = $game->getDeck();

        $values = $deck->getMixedValues(); 
        $values = $deck->random($values);
        
        $deck->setMixedValues($values);
        $game->setDeck($deck);

        $session->set('game', $game);


        return $this->redirectToRoute('game_init');
    }
}
