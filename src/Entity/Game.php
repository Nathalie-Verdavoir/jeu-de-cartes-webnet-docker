<?php

namespace App\Entity;

class Game
{
    private int $num;
    
    public function __construct(int $num =2) {
        $this->num = $num;
    }


    /**
     * Get the value of num
     *
     * @return string
     */
    public function getNum(): string
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

}