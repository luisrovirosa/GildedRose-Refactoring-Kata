package com.gildedrose;

import static org.junit.Assert.assertEquals;

import org.junit.Test;

public class GildedRoseTest {

	private static final String BACKSTAGE_NAME = "Backstage passes to a TAFKAL80ETC concert";
	private static final String NORMAL_ITEM_NAME = "foo";
	private static final String AGED_BRIE_NAME = "Aged Brie";
	private static final String SULFURAS_NAME = "Sulfuras, Hand of Ragnaros";

	private static final int QUALITY_CHANGE = 1;
	private static final int NORMAL_ITEM_QUALITY = 5;
	private static final int MINIMUM_QUALITY = 0;
	private static final int MAXIMUM_QUALITY = 50;

	private static final int SELL_IN_CHANGE = 1;
	private static final int EXPIRED_SELL_IN = 0;
	private static final int NORMAL_ITEM_SELL_IN = 15;
	private static final int SELL_IN_IN_5_DAYS = 5;
	private static final int SELL_IN_IN_10_DAYS = 10;

	@Test
	public void sell_in_decreases_every_day() {
		verifySellIn(NORMAL_ITEM_SELL_IN - SELL_IN_CHANGE, normalItem());
	}

	@Test
	public void quality_decreases_every_day() {
		verifyQuality(NORMAL_ITEM_QUALITY - QUALITY_CHANGE, normalItem());
	}

	@Test
	public void quality_decreases_twice_as_fast_one_sell_in_has_passed() {
		verifyQuality(NORMAL_ITEM_QUALITY - 2 * QUALITY_CHANGE, expiredItem());
	}

	@Test
	public void quality_is_never_negative() {
		verifyQuality(MINIMUM_QUALITY, itemWithoutQuality());
	}

	@Test
	public void aged_brie_increases_quality() {
		verifyQuality(NORMAL_ITEM_QUALITY + QUALITY_CHANGE, agedBrie());
	}

	@Test
	public void item_never_increase_quality_when_has_reached_the_maximum() {
		verifyQuality(MAXIMUM_QUALITY, agedBrieWithMaximumQuality());
	}

	@Test
	public void sulfuras_never_changes_the_quality() {
		verifyQuality(NORMAL_ITEM_QUALITY, sulfuras());
	}

	@Test
	public void sulfuras_never_changes_the_sell_in() {
		verifySellIn(NORMAL_ITEM_SELL_IN, sulfuras());
	}

	// - "Backstage passes",
	// - Increases in Quality as it's SellIn value approaches
	@Test
	public void backstage_increase_quality() {
		verifyQuality(NORMAL_ITEM_QUALITY + QUALITY_CHANGE, backstage());
	}

	@Test
	public void backstage_increase_quality_by_2_when_sell_in_is_10_or_less() {
		verifyQuality(NORMAL_ITEM_QUALITY + 2 * QUALITY_CHANGE, backstageInIn10Days());
	}

	// - By 3 when there are 5 days or less but
	@Test
	public void backstage_increase_quality_by_3_when_sell_in_is_5_or_less() {
		verifyQuality(NORMAL_ITEM_QUALITY + 3 * QUALITY_CHANGE, backstageIn5Days());
	}

	// - Quality drops to 0 after the concert

	private void verifySellIn(int expectedSellIn, Item item) {
		GildedRose gildedRose = gildedRose(item);
		gildedRose.updateQuality();
		assertSellIn(expectedSellIn, gildedRose);
	}

	private void verifyQuality(int expectedQuality, Item normalItem) {
		GildedRose gildedRose = gildedRose(normalItem);
		gildedRose.updateQuality();
		assertQuality(expectedQuality, gildedRose);
	}

	private GildedRose gildedRose(Item item) {
		Item[] items = new Item[] { item };
		GildedRose app = new GildedRose(items);
		return app;
	}

	private Item normalItem() {
		return itemWithNormalSellInAndQuality(NORMAL_ITEM_NAME);
	}

	private Item expiredItem() {
		return new Item(NORMAL_ITEM_NAME, EXPIRED_SELL_IN, NORMAL_ITEM_QUALITY);
	}

	private Item itemWithoutQuality() {
		return new Item(NORMAL_ITEM_NAME, NORMAL_ITEM_SELL_IN, MINIMUM_QUALITY);
	}

	private Item agedBrie() {
		return itemWithNormalSellInAndQuality(AGED_BRIE_NAME);
	}

	private Item agedBrieWithMaximumQuality() {
		return new Item(AGED_BRIE_NAME, NORMAL_ITEM_SELL_IN, MAXIMUM_QUALITY);
	}

	private Item sulfuras() {
		return itemWithNormalSellInAndQuality(SULFURAS_NAME);
	}

	private Item backstage() {
		return itemWithNormalSellInAndQuality(BACKSTAGE_NAME);
	}

	private Item backstageInIn10Days() {
		return new Item(BACKSTAGE_NAME, SELL_IN_IN_10_DAYS, NORMAL_ITEM_QUALITY);
	}

	private Item backstageIn5Days() {
		return new Item(BACKSTAGE_NAME, SELL_IN_IN_5_DAYS, NORMAL_ITEM_QUALITY);
	}

	private Item itemWithNormalSellInAndQuality(String name) {
		return itemWithNormalQuality(name, NORMAL_ITEM_SELL_IN);
	}

	private Item itemWithNormalQuality(String name, int sellIn) {
		return new Item(name, sellIn, NORMAL_ITEM_QUALITY);
	}

	private void assertSellIn(int expectedSellIn, GildedRose app) {
		assertEquals(expectedSellIn, app.items[0].sellIn);
	}

	private void assertQuality(int expectedQuality, GildedRose gildedRose) {
		assertEquals(expectedQuality, gildedRose.items[0].quality);
	}

}
