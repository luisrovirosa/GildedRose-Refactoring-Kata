<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of IncreaseQuality
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
class AgedBrie extends BaseRule
{

    public function match($item)
    {
        return $item->name == 'Aged Brie';
    }

    protected function getQualityIncrement($item)
    {
        return 0 > $item->sell_in ? 2 : 1;
    }

}
