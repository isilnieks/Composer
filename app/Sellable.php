<?php


namespace App;

class Sellable
{
    private string $name;
    private int $amount = 0;
    private int $price;

    public function __construct(string $name, int $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }


    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function addAmount(int $amount): void
    {
        $this->amount += $amount;
    }

    public function removeAmount(int $amount): void
    {
        $this->amount -= $amount;
    }


}