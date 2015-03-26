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
        if ($this->expireInMoreThanOrEquals($item, 10)) {
            return 1;
        } elseif ($this->expireInMoreThanOrEquals($item, 5)) {
            return 2;
        } elseif (!$this->isExpired($item)) {
            return 3;
        } else {
            return -$item->quality;
        }
    }

    /**
     * @param $item
     * @param $days
     * @return bool
     */
    protected function expireInMoreThanOrEquals($item, $days)
    {
        return $item->sell_in >= $days;
    }
}
