<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Offer;
use jugger\yandexYml\SimpleOffer;

class SimpleOfferBuilder extends OfferBuilder
{
	public function buildDOM(Offer $offer): \DOMDocument
	{
		if ((!$offer instanceof SimpleOffer)) {
			throw new \InvalidArgumentException("Arg 'offer' must be extends ". SimpleOffer::class);
		}
		$this->initBeforeBuild($offer);
		$this->elementInitAttributes();

		$this->elementAppendChildProperty("name");
		$this->elementAppendChildPropertyIsSet("model");
		$this->elementAppendChildPropertyIsSet("vendor");
		$this->elementAppendChildPropertyIsSet("vendorCode");

		$this->elementInitGeneralProperties();
		return $this->dom;
	}
}
