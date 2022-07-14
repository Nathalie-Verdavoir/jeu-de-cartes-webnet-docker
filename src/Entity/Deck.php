<?php

namespace App\Entity;


class Deck
{
    private array $goodOrderColors;
    private array $goodOrderValues;
    private array $mixedColors;
    private array $mixedValues;
    private array $mixedDeck;

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

    /**
     * Get the value of goodOrderColors
     *
     * @return array
     */
    public function getGoodOrderColors(): array
    {
        return $this->goodOrderColors;
    }

    /**
     * Set the value of goodOrderColors
     *
     * @param array $goodOrderColors
     *
     * @return self
     */
    public function setGoodOrderColors(array $goodOrderColors): self
    {
        $this->goodOrderColors = $goodOrderColors;

        return $this;
    }

    /**
     * Get the value of goodOrderValues
     *
     * @return array
     */
    public function getGoodOrderValues(): array
    {
        return $this->goodOrderValues;
    }

    /**
     * Set the value of goodOrderValues
     *
     * @param array $goodOrderValues
     *
     * @return self
     */
    public function setGoodOrderValues(array $goodOrderValues): self
    {
        $this->goodOrderValues = $goodOrderValues;

        return $this;
    }

    /**
     * Get the value of mixedColors
     *
     * @return array
     */
    public function getMixedColors(): array
    {
        return $this->mixedColors;
    }

    /**
     * Set the value of mixedColors
     *
     * @param array $mixedColors
     *
     * @return self
     */
    public function setMixedColors(array $mixedColors): self
    {
        $this->mixedColors = $mixedColors;

        return $this;
    }

    /**
     * Get the value of mixedValues
     *
     * @return array
     */
    public function getMixedValues(): array
    {
        return $this->mixedValues;
    }

    /**
     * Set the value of mixedValues
     *
     * @param array $mixedValues
     *
     * @return self
     */
    public function setMixedValues(array $mixedValues): self
    {
        $this->mixedValues = $mixedValues;

        return $this;
    }
}
