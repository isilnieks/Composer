<?php

namespace App;

class FlowerCollection
{
    private array $flowers = [];

    public function getFlowers(): array
    {
        return $this->flowers;
    }

    public function addFlowers(Flower $flower): void
    {
      $this->flowers[] = $flower;
    }


}