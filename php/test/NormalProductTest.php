<?php


namespace LuisRovirosa\GildedRose\Test;

class NormalProductTest extends GildedRoseTest
{
    const PRODUCT_NORMAL = "foo";

    /**
     * @dataProvider remainingDaysProvider
     * @test
     */
    public function shouldDecreaseTheDaysByOne($days, $message)
    {
        $this->createProduct(self::PRODUCT_NORMAL, $days, self::QUALITY_NORMAL);
        $this->nextDay();
        $this->assertExpectedDays($days - 1, $message);
    }

    /**
     * @dataProvider qualityProvider
     * @test
     */
    public function shouldChangeQualityTo($days, $quality, $difference, $message)
    {
        $this->createProduct(self::PRODUCT_NORMAL, $days, $quality);
        $this->nextDay();
        $this->assertQuality($quality - $difference, $message);
    }

    public function remainingDaysProvider()
    {
        return array(
            array(self::SELL_IN_POSITIVE_DAYS, "Positive days"),
            array(self::SELL_IN_EXPIRED_DATE, "Expired date"),
        );
    }

    public function qualityProvider()
    {
        return array(
            array(self::SELL_IN_POSITIVE_DAYS, self::QUALITY_NORMAL, 1, "Positive days decrease quality in 1"),
            array(self::SELL_IN_EXPIRED_DATE, self::QUALITY_NORMAL, 2, "In expired date decrease quality in 2"),
            array(self::SELL_IN_POSITIVE_DAYS, self::QUALITY_ZERO, 0, "Quality never can be lower than 0"),
            array(self::SELL_IN_EXPIRED_DATE, self::QUALITY_ZERO, 0, "Quality never can be lower than 0"),
        );
    }
}
