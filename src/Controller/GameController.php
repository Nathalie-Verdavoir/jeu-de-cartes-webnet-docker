<?php

namespace App\Controller;

use App\Entity\Deck;
use App\Entity\Game;
use App\Form\GameType;
use App\Form\NumberOfCardsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game_index")
     */
    public function gameIndex(): Response
    {

        $deck = new Deck();

        return $this->render('game/index.html.twig', [
            "cards" => $deck->getDeck(),
        ]);
    }

    /**
     * @Route("/", name="game_init", methods={"GET","HEAD"})
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

        return $this->renderForm('game/init.html.twig',array(
            'num' => $numberOfCards,
            ), Response::HTTP_SEE_OTHER);
        
    }

    /**
     * @Route("/random/{numberOfCards}", name="game_index_random")
     */
    public function gameHand(int $numberOfCards = 5, Request $request): Response
    {
        
        $session = $request->getSession();  
        $deck = new Deck();
        $colors = $deck->colors; 
        $goodOrderColors = $deck->goodOrderColors;
        $values = $deck->values; 
        $goodOrderValues = $deck->goodOrderValues; 
        $cards = $deck->deck;
        $result =  [];
       
            $index = array_rand($cards,$numberOfCards); 
            for ($i=0;$i < $numberOfCards ;$i++){   
                $result[$index[$i]] = $cards[$index[$i]];  
                unset($cards[$index[$i]]); 
            }
        $session->set('cards', $cards);
        $session->set('result', $result);
        


        return $this->render('game/play.html.twig', [
            "colors" => $colors,
            "values" => $values,
            "goodOrderColors" => $goodOrderColors,
            "goodOrderValues" => $goodOrderValues,
        ]);
    }
}
