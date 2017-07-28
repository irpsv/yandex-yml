<?php

namespace jugger\yandexYml;

class Currency
{
	const ID_RUR = "RUR";
	const ID_USD = "USD";
	const ID_EUR = "EUR";
	const ID_UAH = "UAH";
	const ID_KZT = "KZT";

	const RATE_RU = "CBRF";
	const RATE_UA = "NBU";
	const RATE_KZ = "NBK";
	const RATE_CB = "CB";

	public $id;
	public $rate;

	public function __construct(string $id, string $rate = self::RATE_CB)
	{
		$this->id = $id;
		$this->rate = $rate;
	}
}
