<?php

namespace App\Controller;

use App\Entity\Deck;
use App\Entity\Game;
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
    {   $numberOfCards = new Game();
        $form = $this->createForm(GameType::class, $numberOfCards);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
        return $this->redirectToRoute('game_index_random', [
            "numberOfCards" => $form->getData('num')->getNum(),
        ]);
        }

        return $this->render('game/init.html.twig',array(
            'form' => $form->createView(),
            ));
        
    }

    /**
     * @Route("/random/{numberOfCards}", name="game_index_random")
     */
    public function gameHand(int $numberOfCards = 5, Request $request): Response
    {
        
        $session = $request->getSession();  
        $deck = new Deck();
        $colors = $deck->mixedColors; 
        $goodOrderColors = $deck->goodOrderColors;
        $values = $deck->mixedValues; 
        $goodOrderValues = $deck->goodOrderValues; 
        $cards = $deck->getMixedDeck();
        $result =  [];
        $orderedResult =  [];
       
            $index = array_rand($cards,$numberOfCards); 
            for ($i=0;$i < $numberOfCards ;$i++){   
                $result[$index[$i]] = $cards[$index[$i]];  
                unset($cards[$index[$i]]); 
            }
        $session->set('result', $result);
        
        foreach ($goodOrderColors as $color){
            foreach ($goodOrderValues as $value){
                /** @var Card $card */
                foreach ($result as $card){
                    if ($card->getColor() == $color and  $card->getValue() == $value){
                        array_push($orderedResult,$card);
                    }
                } 
            }    
        }

        $session->set('orderedResult', $orderedResult);


        return $this->render('game/play.html.twig', [
            "colors" => $colors,
            "values" => $values,
            "goodOrderColors" => $goodOrderColors,
            "goodOrderValues" => $goodOrderValues,
        ]);
    }
}
