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
    private Deck $deck;
    private ColorName $colorName;
    private ValueName $valueName;

    public function __construct(int $num =2, string $cardsTemplate= '') {
        $this->num = $num;
        $this->cardsTemplate = $cardsTemplate;

        /** @var Deck $deck */
        $this->deck = new Deck();

        /** @var ColorName $colorName */
        $this->colorName = new ColorName();
  
        /** @var ValueName $valueName */
        $this->valueName = new ValueName();
        
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

    /**
     * Get the value of deck
     *
     * @return Deck
     */
    public function getDeck(): Deck
    {
        return $this->deck;
    }

    /**
     * Set the value of deck
     *
     * @param Deck $deck
     *
     * @return self
     */
    public function setDeck(Deck $deck): self
    {
        $this->deck = $deck;

        return $this;
    }

    /**
     * Get the value of colorName
     *
     * @return ColorName
     */
    public function getColorName(): ColorName
    {
        return $this->colorName;
    }

    /**
     * Set the value of colorName
     *
     * @param ColorName $colorName
     *
     * @return self
     */
    public function setColorName(ColorName $colorName): self
    {
        $this->colorName = $colorName;

        return $this;
    }

    /**
     * Get the value of valueName
     *
     * @return ValueName
     */
    public function getValueName(): ValueName
    {
        return $this->valueName;
    }

    /**
     * Set the value of valueName
     *
     * @param ValueName $valueName
     *
     * @return self
     */
    public function setValueName(ValueName $valueName): self
    {
        $this->valueName = $valueName;

        return $this;
    }
}
