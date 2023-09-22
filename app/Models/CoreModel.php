<?php

namespace Pokedex\Models;

class CoreModel
{
    protected $id;
    protected $name;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }
}