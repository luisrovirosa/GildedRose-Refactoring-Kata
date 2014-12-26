<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of BaseRule
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
abstract class BaseRule
{

    public function apply($item)
    {
        $this->updateSellIn($item);
        $this->updateQuality($item);
    }

    protected function updateSellIn($item)
    {
        $item->sell_in--;
    }

    protected function updateQuality($item)
    {
        $item->quality = $item->quality + $this->getQualityIncrement($item);
        $this->assertMinimumValue($item);
        $this->assertMaximumValue($item);
    }

    private function assertMinimumValue($item)
    {
        $item->quality = max(0, $item->quality);
    }

    private function assertMaximumValue($item)
    {
        $item->quality = min(50, $item->quality);
    }

    abstract public function match($item);

    abstract protected function getQualityIncrement($item);
}
