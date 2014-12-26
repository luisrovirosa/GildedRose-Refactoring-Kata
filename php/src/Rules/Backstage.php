<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of Backstage
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
class Backstage extends BaseRule
{

    public function match($item)
    {
        return $item->name == 'Backstage passes to a TAFKAL80ETC concert';
    }

    protected function getQualityIncrement($item)
    {
        if ($item->sell_in > 10) {
            return 1;
        } else if ($item->sell_in > 5) {
            return 2;
        } else if ($item->sell_in > 0) {
            return 3;
        } else {
            return -$item->quality;
        }
    }

}
