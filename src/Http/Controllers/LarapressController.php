<?php

namespace Jhalarde\Larapress\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class LarapressController extends Controller
{
	/**
	 * @var \Illuminate\Config\Repository
	 */
	private $postUri;

	/**
	 * @var \Illuminate\Config\Repository
	 */
	private $responseIdentifier;

	public function __construct()
	{
		$this->postUri = config('larapress.get_post_uri');
		$this->responseIdentifier = config('larapress.response_identifier');

		if (!$this->postUri || !$this->responseIdentifier) {
			throw new \Exception("Config Incomplete.");
		}
	}

	public function getPost($id)
	{
		$link = "{$this->postUri}/$id";

		$json = file_get_contents($link);

		$arr = json_decode($json, true);

		$response = Arr::get($arr, $this->responseIdentifier);

		return view('larapress::larapress')->with(['response' => $response, 'id' => $id]);
    }
}
