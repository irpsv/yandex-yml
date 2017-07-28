<?php

namespace jugger\yandexYml;

class Delivery
{
	public $cost;
	public $days;
	public $orderBefore;

	public function __construct(float $cost, string $days = null, int $orderBefore = null)
	{
		$this->cost = $cost;
		$this->days = $days;
		$this->orderBefore = $orderBefore;
	}
}
