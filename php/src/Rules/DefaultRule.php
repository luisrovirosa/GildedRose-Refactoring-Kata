<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of Default
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
class DefaultRule extends BaseRule
{

    protected function getQualityIncrement($item)
    {
        return 0 > $item->sell_in ? -2 : -1;
    }

    public function match($item)
    {
        return true;
    }

}
