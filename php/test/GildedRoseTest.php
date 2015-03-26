<?php

namespace LuisRovirosa\GildedRose\Test;

use LuisRovirosa\GildedRose\Item;
use LuisRovirosa\GildedRose\GildedRose;

abstract class GildedRoseTest extends \PHPUnit_Framework_TestCase
{

    const PRODUCT_NORMAL = "foo";
    const PRODUCT_AGED_BRIE = "Aged Brie";
    const PRODUCT_SULFURAS = "Sulfuras, Hand of Ragnaros";
    const PRODUCT_BACKSTAGE = "Backstage passes to a TAFKAL80ETC concert";
    const SELL_IN_POSITIVE_DAYS = 10;
    const SELL_IN_MORE_THAN_10_DAYS = 20;
    const SELL_IN_5_DAYS = 5;
    const SELL_IN_0_DAYS = 0;
    const SELL_IN_EXPIRED_DATE = -10;
    const QUALITY_NORMAL = 10;
    const QUALITY_MAXIMUM = 50;
    const QUALITY_ZERO = 0;

}
