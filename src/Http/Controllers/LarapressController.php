<?php

namespace Jhalarde\Larapress\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

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

	/**
	 * @var \Illuminate\Config\Repository
	 */
	private $isCacheEnabled;

	/**
	 * LarapressController constructor.
	 *
	 * @throws \Exception
	 */
	public function __construct()
	{
		$this->isCacheEnabled = config('larapress.cache');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Exception
	 */
	public function getPost($id)
	{
		$this->checkConfig();

		if (Cache::has($id)) {
			$response = Cache::get($id);

			return $this->gotoView($response, $id);
		}

		$response = $this->getJson($id);

		if ($this->isCacheEnabled) {
			Cache::add($id, $response, null);
		}

		return $this->gotoView($response, $id);
    }

	/**
	 * @param $response
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	private function gotoView($response, $id)
	{
		return view('larapress::larapress')->with(['response' => $response, 'id' => $id]);
    }

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	private function getJson($id)
	{
		$link = "{$this->postUri}/$id";

		$json = file_get_contents($link);

		$arr = json_decode($json, true);

		return Arr::get($arr, $this->responseIdentifier);
    }

	/**
	 * @throws \Exception
	 */
	private function checkConfig()
	{
		$this->postUri = config('larapress.get_post_uri');
		$this->responseIdentifier = config('larapress.response_identifier');

		if (!$this->postUri || !$this->responseIdentifier) {
			throw new \Exception("Config Incomplete.");
		}
	}
}
