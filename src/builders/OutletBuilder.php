<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Outlet;

class OutletBuilder
{
	public function buildDOM(Outlet $model): \DOMDocument
	{
		$dom = new \DOMDocument;
		$element = $dom->createElement("outlet");
		$element->setAttribute('id', $model->id);
		if ($model->instock) {
			$element->setAttribute('instock', $model->instock);
		}
		if ($model->booking) {
			$element->setAttribute('booking', "true");
		}

		$dom->appendChild($element);
		return $dom;
	}

	public function build(Outlet $model): string
	{
		$dom = $this->buildDOM($model);
		$node = $dom->getElementsByTagName('outlet')->item(0);
		return $dom->saveXML($node);
	}
}
