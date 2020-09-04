<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Contracts\MakesInternalRequests;
use Illuminate\Foundation\Application;
use App\Exceptions\FailedInternalRequestException;
use Illuminate\Support\Facades\Route;

/**
 * Internal request service
 */
class InternalRequest implements MakesInternalRequests
{
	/**
	 * The app instance
	 *
	 * @var $app
	 */
	protected $app;

	/**
	 * Constructor
	 *
	 * @param Application $app The app instance.
	 * @return void
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Make an internal request
	 *
	 * @param string $action   The HTTP verb to use.
	 * @param string $resource The API resource to look up.
	 * @param array  $data     The request body.
	 * @return \Illuminate\Http\Response
	 * @throws FailedInternalRequestException Request could not be synced.
	 */
	public function request(string $action, string $resource, array $data = [])
	{
		// Create request
		$request = Request::create($resource, $action, $data, [], [], [
			'Accept' => 'application/json',
		]);
		// Get response
		$response = $this->app->handle($request);
		if ($response->getStatusCode() >= 400) {
			throw new FailedInternalRequestException($request, $response);
		}
		// Dispatch the request
		return $response;
	}

	/**
	 * @param string $action
	 * @param string $resource
	 * @param array  $data
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
	 */
	public function dispatch(string $action, string $resource, array $data = [])
	{
		/** Create request */
		$request = Request::create($resource, $action, $data, [], [], [
			'Accept' => 'application/json',
		]);

		//** Get response & Dispatch the request */
		return Route::dispatch($request);
	}
}
