<?php namespace Api\v1;

use Illuminate\Support\Facades\Response;
use \WagerSession;
use \Input;

class WagerSessionsController extends \BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $contents = WagerSession::all();
    $statusCode = 200;
    $value = 'application/json';

    $response = Response::make($contents, $statusCode);
    $response->header('Content-Type', $value);

    return $response;
  }

}