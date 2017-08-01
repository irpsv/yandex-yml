<?php

namespace jugger\yandexYml\builders;

use jugger\yandexYml\Offer;
use jugger\yandexYml\ArbitraryOffer;

class ArbitraryOfferBuilder extends OfferBuilder
{
	public function buildDOM(Offer $offer): \DOMDocument
	{
		if ((!$offer instanceof ArbitraryOffer)) {
			throw new \InvalidArgumentException("Arg 'offer' must be extends ". ArbitraryOffer::class);
		}
		$this->initBeforeBuild($offer);
		$this->elementInitAttributes();

		$this->elementSetAttribute('type');
		$this->elementAppendChildProperty('model');
		$this->elementAppendChildProperty('vendor');
		$this->elementAppendChildPropertyIsSet('vendorCode');
		$this->elementAppendChildPropertyIsSet('typePrefix');

		$this->elementInitGeneralProperties();
		return $this->dom;
	}
}
