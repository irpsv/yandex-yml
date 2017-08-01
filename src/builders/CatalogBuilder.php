<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Shop;

class CatalogBuilder
{
	public function buildDOM(Shop $shop, $date): \DOMDocument
	{
		$dom = new \DOMDocument();
		$shop = (new ShopBuilder)->buildDom($shop)
			->getElementsByTagName('shop')
			->item(0);


		$element = $dom->createElement("yml_catalog");
		$element->setAttribute("date", $date);
		$element->appendChild(
			$dom->importNode($shop, true)
		);
		$dom->appendChild($element);

		return $dom;
	}

	public function build(Shop $shop, string $date): string
	{
		$dom = $this->buildDOM($shop, $date);
		$dom->encoding = "UTF-8";
		return $dom->saveXML();
	}
}
