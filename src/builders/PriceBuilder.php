<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Price;

class PriceBuilder
{
	public function buildDOM(Price $model): \DOMDocument
	{
		$dom = new \DOMDocument;
		$element = $dom->createElement("price", "$model->amount");
		if ($model->from) {
			$element->setAttribute('from', "true");
		}
		$dom->appendChild($element);
		return $dom;
	}

	public function build(Price $model): string
	{
		$dom = $this->buildDOM($model);
		$node = $dom->getElementsByTagName('price')->item(0);
		return $dom->saveXML($node);
	}
}
