<?php

namespace LuisRovirosa\GildedRose\Rules;

/**
 * Description of BaseRule
 *
 * @author Luis Rovirosa <luisrovirosa@gmail.com>
 */
abstract class BaseRule
{

    abstract public function match($item);

    public function apply($item)
    {
        $this->updateSellIn($item);
        $this->updateQuality($item);
    }

    protected function updateSellIn($item)
    {
        $this->decreaseOneDayToExpire($item);
    }

    abstract protected function getQualityIncrement($item);

    /**
     * @param $item
     * @return bool
     */
    protected function isExpired($item)
    {
        return $item->sell_in < 0;
    }

    private function updateQuality($item)
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

    private function decreaseOneDayToExpire($item)
    {
        $item->sell_in--;
    }
}
