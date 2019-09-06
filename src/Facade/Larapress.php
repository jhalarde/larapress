<?php

namespace Jhalarde\Larapress\Facade;

use Illuminate\Support\Facades\Facade;

class Larapress extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'larapress';
	}
}