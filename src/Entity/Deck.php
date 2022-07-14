<?php

namespace App\Entity;

class Deck
{
    public array $goodOrderColors;
    public array $goodOrderValues;
    public array $mixedColors;
    public array $mixedValues;
    public array $mixedDeck;

    public function __construct() {
        $this->mixedColors = $this->goodOrderColors = ['C','D','H','S'];
        $keys = array_keys( $this->mixedColors);
        shuffle($keys);
        foreach($keys as $key) {
            $new[$key] =  $this->mixedColors[$key];
        }
        $this->mixedColors = $new;

        $this->mixedValues = $this->goodOrderValues = ['2','3','4','5','6','7','8','9','T','J','Q','K','A'];
        $keys = array_keys( $this->mixedValues);
        shuffle($keys);
        foreach($keys as $key) {
            $new[$key] =  $this->mixedValues[$key];
        }
        $this->mixedValues = $new;
        
        $this->mixedCards();
    }

    public function mixedCards()
    {
        foreach ($this->mixedColors AS $color) {
            foreach ($this->mixedValues AS $value) {
                $mixedDeck[] = new Card($color,$value);
                $this->mixedDeck = $mixedDeck;
            }
        }
    }

    /**
     * Get the value of mixedDeck
     *
     * @return array
     */
    public function getMixedDeck(): array
    {
        return $this->mixedDeck;
    }
}