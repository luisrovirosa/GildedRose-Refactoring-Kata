<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of IncreaseQuality
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
class AgedBrie
{

    public function match($item)
    {
        return $item->name == 'Aged Brie';
    }

    public function apply($item)
    {
        $item->sell_in--;
        $this->updateQuality($item);
    }

    public function updateQuality($item)
    {
        $item->quality = min(50, $item->quality + $this->getQualityIncrement($item));
    }

    protected function getQualityIncrement($item)
    {
        return 0 > $item->sell_in ? 2 : 1;
    }

}
