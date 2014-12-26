<?php

namespace LuisRovirosa\GildedRose;

use LuisRovirosa\GildedRose\Rules\AgedBrie;
use LuisRovirosa\GildedRose\Rules\Backstage;
use LuisRovirosa\GildedRose\Rules\Sulfuras;

class GildedRose
{

    private $items;
    private $rules;

    function __construct($items)
    {
        $this->items = $items;
        $this->rules = array(new AgedBrie(), new Backstage(), new Sulfuras());
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

        if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
            if ($item->quality > 0) {
                if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                    $item->quality = $item->quality - 1;
                }
            }
        }

        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->sell_in = $item->sell_in - 1;
        }

        if ($item->sell_in < 0) {
            if ($item->name != 'Aged Brie') {
                if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->quality > 0) {
                        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                            $item->quality = $item->quality - 1;
                        }
                    }
                }
            }
        }
    }

}
