<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of Sulfuras
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
class Sulfuras extends BaseRule
{

    protected function getQualityIncrement($item)
    {
    }

    protected function updateSellIn($item)
    {
    }

    public function match($item)
    {
        return $item->name == 'Sulfuras, Hand of Ragnaros';
    }
}
