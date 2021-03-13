<?php

namespace App;

class Flower
{
    private string $name;
    private int $amount = 0;
    private int $price;

    public function __construct(string $name, int $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function addAmount(int $amount): void
    {
        $this->amount += $amount;
    }

    public function removeAmount(int $amount): void
    {
        $this->amount -= $amount;
    }




}