<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of IncreaseQuality
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
class AgedBrie extends BaseRule
{

    const INCREASE_AT_NORMAL_SPEED = 1;

    public function match($item)
    {
        return $item->name == 'Aged Brie';
    }

    protected function getQualityIncrement($item)
    {
        return self::INCREASE_AT_NORMAL_SPEED;
    }
}
