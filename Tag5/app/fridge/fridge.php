<?php

namespace app\fridge;

/**
 * Class fridge
 *
 * A simple fridge class to store items.
 */
class fridge
{
    /**
     * @var array List of items in the fridge
     */
    public array $items = [];

    /**
     * Fridge constructor.
     *
     * @param array $items Initial items in the fridge
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }
}
