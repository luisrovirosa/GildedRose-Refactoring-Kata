package com.gildedrose;

class GildedRose {
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
		if (!isAgedBrie(item) && !isBackstage(item)) {
			if (hasQuality(item)) {
				if (!isSulfuras(item)) {
					decreaseQuality(item);
				}
			}
		} else {
			if (hasNotMaximumQuality(item)) {
				increaseQuality(item);

				if (isBackstage(item)) {
					if (item.sellIn < 11) {
						if (item.quality < 50) {
							increaseQuality(item);
						}
					}

					if (item.sellIn < 6) {
						if (item.quality < 50) {
							increaseQuality(item);
						}
					}
				}
			}
		}

		if (!isSulfuras(item)) {
			item.sellIn = item.sellIn - 1;
		}

		if (item.sellIn < 0) {
			if (!isAgedBrie(item)) {
				if (!isBackstage(item)) {
					if (hasQuality(item)) {
						if (!isSulfuras(item)) {
							decreaseQuality(item);
						}
					}
				} else {
					item.quality = item.quality - item.quality;
				}
			} else {
				if (item.quality < 50) {
					increaseQuality(item);
				}
			}
		}
	}

	private int increaseQuality(Item item) {
		return item.quality = item.quality + 1;
	}

	private boolean hasNotMaximumQuality(Item item) {
		return item.quality < MAXIMUM_QUALITY;
	}

	private int decreaseQuality(Item item) {
		return item.quality = item.quality - 1;
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
