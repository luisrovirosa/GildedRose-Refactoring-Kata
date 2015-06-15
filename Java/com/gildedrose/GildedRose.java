package com.gildedrose;

class GildedRose {
	private static final int FIVE_DAYS = 5;
	private static final int TEN_DAYS = 10;
	private static final int MAXIMUM_QUALITY = 50;
	private static final String SULFURAS_NAME = "Sulfuras, Hand of Ragnaros";
	private static final String AGED_BRIE_NAME = "Aged Brie";
	private static final String BACKSTAGE_NAME = "Backstage passes to a TAFKAL80ETC concert";
	Item[] items;

	public GildedRose(Item[] items) {
		this.items = items;
	}

	public void updateQuality() {
		for (int i = 0; i < items.length; i++) {
			update(items[i]);
		}
	}

	private void update(Item item) {
		if (isAgedBrie(item)) {
			increaseQuality(item);
		} else if (!isAgedBrie(item) && !isBackstage(item)) {
			if (!isSulfuras(item)) {
				decreaseQuality(item);
			}
		} else {
			increaseQuality(item);

			if (isBackstage(item)) {
				if (item.sellIn <= TEN_DAYS) {
					increaseQuality(item);
				}

				if (item.sellIn <= FIVE_DAYS) {
					increaseQuality(item);
				}
			}
		}

		decreaseSellIn(item);

		if (hasExpired(item)) {
			if (isAgedBrie(item)) {
				increaseQuality(item);
			} else if (isBackstage(item)) {
				removeAllQuality(item);
			} else if (!isSulfuras(item)) {
				decreaseQuality(item);
			}
		}
	}

	private void removeAllQuality(Item item) {
		item.quality = item.quality - item.quality;
	}

	private boolean hasExpired(Item item) {
		return item.sellIn < 0;
	}

	private void decreaseSellIn(Item item) {
		if (!isSulfuras(item)) {
			item.sellIn = item.sellIn - 1;
		}
	}

	private void increaseQuality(Item item) {
		if (hasNotMaximumQuality(item)) {
			item.quality = item.quality + 1;
		}
	}

	private boolean hasNotMaximumQuality(Item item) {
		return item.quality < MAXIMUM_QUALITY;
	}

	private void decreaseQuality(Item item) {
		if (hasQuality(item)) {
			item.quality = item.quality - 1;
		}
	}

	private boolean isSulfuras(Item item) {
		return item.name.equals(SULFURAS_NAME);
	}

	private boolean hasQuality(Item item) {
		return item.quality > 0;
	}

	private boolean isBackstage(Item item) {
		return item.name.equals(BACKSTAGE_NAME);
	}

	private boolean isAgedBrie(Item item) {
		return item.name.equals(AGED_BRIE_NAME);
	}
}
