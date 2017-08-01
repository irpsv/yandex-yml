<?php

namespace jugger\yandexYml;

class Price
{
	public $amount;
	public $from;

	public function __construct(float $amount, bool $from = false)
	{
		$this->amount = $amount;
		$this->from = $from;
	}
}
