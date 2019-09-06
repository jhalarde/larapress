<?php

use Jhalarde\Larapress\Facade\Larapress;

if (! function_exists('larapressRender')) {
	function larapressRender ($id) {
		return Larapress::getPost($id);
	}
}