<?php

namespace jugger\yandexYml;

class Outlet
{
	public $id;
	public $instock;
	public $booking;

	public function __construct(string $id, int $instock, bool $booking = false)
	{
		$this->id = $id;
		$this->instock = $instock;
		$this->booking = $booking;
	}
}
