<?php

namespace LuisRovirosa\GildedRose;

use LuisRovirosa\GildedRose\Rules\AgedBrie;
use LuisRovirosa\GildedRose\Rules\Backstage;
use LuisRovirosa\GildedRose\Rules\Sulfuras;
use LuisRovirosa\GildedRose\Rules\DefaultRule;

class GildedRose
{

    private $items;
    private $rules;

    function __construct($items)
    {
        $this->items = $items;
        $this->rules = array(new AgedBrie(), new Backstage(), new Sulfuras(), new DefaultRule());
    }

    function update_quality()
    {
        foreach ($this->items as $item) {
            $this->updateItem($item);
        }
    }

    private function updateItem($item)
    {
        foreach ($this->rules as $rule) {
            if ($rule->match($item)) {
                $rule->apply($item);

                return;
            }
        }
    }
}
