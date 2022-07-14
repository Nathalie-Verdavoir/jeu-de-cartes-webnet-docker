<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Game
{
    /**
     * @Assert\LessThan(53, message ="Vous devez choisir entre 1 et 52 cartes")
     * @Assert\GreaterThan(0, message = "Vous devez choisir entre 1 et 52 cartes")
     */
    private int $num;
    private string $cardsTemplate;

    public function __construct(int $num =2, string $cardsTemplate= '') {
        $this->num = $num;
        $this->cardsTemplate = $cardsTemplate;

        
    }


    /**
     * Get the value of num
     *
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * Set the value of num
     *
     * @param int $num
     *
     * @return self
     */
    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }
    
    /**
     * Get the value of cardsTemplate
     */
    public function getCardsTemplate(): string
    {
            return $this->cardsTemplate;
    }

    /**
     * Set the value of cardsTemplate
     *
     * @param string $cardsTemplate
     *
     * @return self
     */
    public function setCardsTemplate(string $cardsTemplate): self
    {
        $this->cardsTemplate = $cardsTemplate;

        return $this;
    }
}