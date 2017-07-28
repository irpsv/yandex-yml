<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Currency;

class CurrencyBuilder
{
	public function buildDOM(Currency $model): \DOMDocument
	{
		$dom = new \DOMDocument;
		$element = $dom->createElement("currency");
		$element->setAttribute('id', $model->id);
		$element->setAttribute('rate', $model->rate);

		$dom->appendChild($element);
		return $dom;
	}

	public function build(Currency $model): string
	{
		$dom = $this->buildDOM($model);
		$node = $dom->getElementsByTagName('currency')->item(0);
		return $dom->saveXML($node);
	}
}
