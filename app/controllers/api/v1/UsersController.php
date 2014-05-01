<?php namespace Api\v1;

use Illuminate\Support\Facades\Response;
use \User;
use \Token;
use \Input;
use \Datetime;
use \DateInterval;
use \Auth;
use \Hash;
use \Course;
use \Wager;

class UsersController extends \BaseController {

	public function index()
	{
		$contents = User::all();
		$statusCode = 200;
		$value = 'application/json';

		$response = Response::make($contents, $statusCode);

		$response->header('Content-Type', $value);

		return $response;
	}

	public function show($id)
	{
		$user = User::find($id);

		if ($user)
		{
			$statusCode = 200;
			$value = 'application/json';
			$response = Response::make($user, $statusCode);
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or unlisted User id';
			$response = Response::make($contents, $statusCode);
		}

		$response->header('Content-Type', $value);

		return $response;
	}

	/**
	 * Register the user
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();

		// Creating a default value for pointBalance for when we create the user
		$pointBalance = (isset($input['pointBalance'])) ? $input['pointBalance'] : 100;

		try
		{  // Try to make a user with the input given
			$user = User::create([
				'emailAddress' => $input['emailAddress'],
				'password' => Hash::make($input['password']),
				'firstName' => $input['firstName'],
				'lastName' => $input['lastName'],
				'pointBalance' => $pointBalance
			]);

			// Create a token for the user
			$currentDate = new Datetime;
			$expDate = $currentDate->add(new DateInterval('P6M'));

			$token = Token::create([
					'token' => str_random(40),
					'user_id' => $user->id,
					'valid_until' => $expDate
				]);

			$content = [
				'user_id' => $user->id,
				'message' => 'Success, the user was registered',
				'token' => $token->token];

			$statusCode = 200;
			$value = 'plain/text';
			$contents = json_encode($content);

			$response = Response::make($contents, $statusCode);
			$response->header('Content-Type', $value);
		}
		catch (\Exception $e)
		{ // Something went wrong

			$statusCode = 400;
			$value = 'plain/text';
			$contents = 'Error, could not create the User. Exception: ' . $e;
			$response = Response::make($contents, $statusCode);
			$response->header('Content-Type', $value);
		}

		return $response;
	}

	/**
	 * Updating a user
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);

		if ($user)
		{ // If we can find the User, update the model with the data given
			$postInput = file_get_contents('php://input');
			$data = json_decode($postInput, true);

			try
			{ // Try to update the user's properties by seeing if the property is defined
			  // in the submitted data payload, otherwise set it equal to itself
				$user->emailAddress = (isset($data['emailAddress'])) ? $data['emailAddress'] : $user->emailAddress;
				$user->password = (isset($data['password'])) ? $data['password'] : $user->password;
				$user->username = (isset($data['username'])) ? $data['username'] : $user->username;
				$user->firstName = (isset($data['firstName'])) ? $data['firstName'] : $user->firstName;
				$user->lastName = (isset($data['lastName'])) ? $data['lastName'] : $user->lastName;
				$user->pointBalance = (isset($data['pointBalance'])) ? $data['pointBalance'] : $user->pointBalance;

				$user->save();

				$statusCode = 200;
				$value = 'text/plain';
				$contents = 'Success, User updated.';
			}
			catch (\Exception $e)
			{ // One of the values we were trying to update is invalid
				$statusCode = 400;
				$value = 'text/plain';
				$contents = 'Invalid submitted User data. Exception: ' . $e;
			}
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or unlisted User id';
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}

	public function destroy($id)
	{
		$user = User::find($id);

		if ($user)
		{
			$user->delete();

			$statusCode = 200;
			$value = 'application/json';
			$contents = 'Success, User deleted';
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or unlisted User id';
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}

	public function getCourses($id)
	{
		$user = User::find($id);

		if ($user)
		{
			$contents = $user->courses;
			$statusCode = 200;
			$value = 'application/json';
		}
		else
		{
			$statusCode = 400;
			$value = 'text/plain';
			$contents = 'Invalid or undefined User id';
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}
	/**
	 * Login the user and retrieve their access token
	 *
	 * @return JSON Response
	 */
	public function login()
	{
		$credentials = ['emailAddress' => Input::get('emailAddress'), 'password' => Input::get('password')];

		$login = Auth::attempt($credentials);

		if ($login)
		{ // Valid credentials
			$statusCode = 200;
			$value = 'application/json';

			// Lookup to see if the user has a token in the database
			$token = Token::where('user_id', Auth::user()->id)->first();

			$currentDate = new Datetime;
			$expDate = $currentDate->add(new DateInterval('P6M'));

			// Check to see if the user's access token is expired
			if ($token && !$token->isValidToken())
			{ // Token exists but is not valid

				// Update the token field value and the expiration date.
				$token->token = str_random(40);
				$token->valid_until = $expDate;
				$token->save();
			}
			else if (!$token)
			{ // No token for the user, we need to create one

				Token::create([
					'token' => str_random(40),
					'user_id' => Auth::user()->id,
					'valid_until' => $expDate
				]);
			} // Otherwise our token is valid

			$content = [
				'user_id' => Auth::user()->id,
				'message' => 'Success, valid credentials',
				'token' => Auth::user()->token->token // need to call twice to access actual token value
			];

			$contents = json_encode($content);
		}
		else
		{ // Invalid redentials
			$statusCode = 400;
			$value = 'application/json';
			$contents = json_encode(['message' => 'Error, invalid credentials']);
		}

		$response = Response::make($contents, $statusCode);
		$response->header('Content-Type', $value);

		return $response;
	}

  /**
   * Grab the wagers for a specific user
   *
   * @param int
   * @return Response
   */
  public function getWagers($id)
  {
    $user = User::find($id);

    if ($user)
    { // We found the user, now grab their wagers
      $statusCode = 200;
      $value = 'application/json';
      // Check to see if the Eloquent collection is empty, if so then no wagers exist for the user
      $contents = ($user->wagers->isEmpty()) ? json_encode(['message' => 'No wagers found for this user']) : $user->wagers;
    }
    else
    { // No record found for that user
      $statusCode = 400;
      $value = 'application/json';
      $contents = json_encode(['message' => 'Error, no user found']);
    }

    $response = Response::make($contents, $statusCode);
    $response->header('Content-Type', $value);

    return $response;
  }

  /**
   * Removes a course from a user's schedule
   *
   * @param int
   * @return Response
   */
  public function removeCourse($user_id, $course_id)
  {
    $user = User::find($user_id);

    if ($user)
    { // We found the user, now try and find the course with $course_id
      $userCourses = $user->courses;

      if ($userCourses->find($course_id))
      { // We found the course, now remove it
        $user->courses()->detach($course_id);
        $statusCode = 200;
        $value = 'application/json';
        $contents = json_encode(['message' => 'Success, the course was removed successfully']);
      }
      else
      { // The user doesn't have that course, so they can't remove it
        $statusCode = 400;
        $value = 'application/json';
        $contents = json_encode(['message' => 'Error, the user doesn\'t have any course with that id']);
      }
    }
    else
    {
      $statusCode = 400;
      $value = 'application/json';
      $contents = json_encode(['message' => 'Error, no user found']);
    }

    $response = Response::make($contents, $statusCode);
    $response->header('Content-Type', $value);

    return $response;
  }

  /**
   * Add a course to a user's schedule
   *
   * @param int
   * @return Response
   */
  public function addCourse($id)
  {
    $user = User::find($id);
    $course = Course::find(Input::get('course_id'));

    if ($user && $course)
    { // We found the user, now need to check to see if they have the class already

      if ($user->courses->find($course->id))
      { // The user has the class already
        $statusCode = 400;
        $value = 'application/json';
        $contents = json_encode(['message' => 'Error, the user already has that class']);
      }
      else
      { // Add the class to the user
        $user->courses()->attach($course->id);
        $statusCode = 200;
        $value = 'application/json';
        $contents = json_encode(['message' => 'Success, the class has been added to the user']);
      }

    }
    else
    { // Either the $user or $course couldn't be found
      $message = ($user) ? 'Error, no course found for that id' : 'Error, no user found for that id';
      $statusCode = 400;
      $value = 'application/json';
      $contents = json_encode(['message' => $message]);
    }

    $response = Response::make($contents, $statusCode);
    $response->header('Content-Type', $value);

    return $response;
  }

  /**
   * Add a wager for a user
   *
   * @param int
   * @return Response
   */
  public function addWager($id)
  {

    $user = User::find($id);

    if ($user)
    { // Found the user
      $wager = Wager::create([
          'user_id' => $id,
          'session_id' => Input::get('session_id'),
          'wagerUnitValue' => Input::get('wagerUnitValue'),
          'wagerTotalValue' => Input::get('wagerTotalValue')
        ]);

      $statusCode = 200;
      $value = 'application/json';
      $contents = json_encode(['message' => 'Success, wager created and added to the user', 'id' => $wager->id]);
    }
    else
    { // The user couldn't be found
      $message = 'Error, no user found for that id';
      $statusCode = 400;
      $value = 'application/json';
      $contents = json_encode(['message' => $message]);
    }

    $response = Response::make($contents, $statusCode);
    $response->header('Content-Type', $value);

    return $response;
  }

  /**
   * Delete a wager for a user
   *
   * @param int
   * @return Response
   */
  public function removeWager($user_id, $wager_id)
  {
    $wager = Wager::find($wager_id);

    if ($wager)
    {
      $wager->delete();
      $statusCode = 200;
      $value = 'applicatoin/json';
      $contents = json_encode(['message' => 'Success, wager deleted']);
    }
    else
    { // The wager couldn't be found
      $message = 'Error, no wager found for that id';
      $statusCode = 400;
      $value = 'application/json';
      $contents = json_encode(['message' => $message]);
    }

    $response = Response::make($contents, $statusCode);
    $response->header('Content-Type', $value);

    return $response;
  }

  /**
   * Edit a specific wager for a user
   *
   * @param int
   * @return Response
   */
  public function editWager($user_id, $wager_id)
  {
    // Try to find the user and corresponding wager associated with them
    $user = User::find($user_id);
    $wager = ($user) ? $user->wagers()->find($wager_id) : null;

    // Grab the inputs
    $wagerUnitValue = Input::get('wagerUnitValue');
    $wagerTotalValue = Input::get('wagerTotalValue');

    if ($user && $wager)
    {
      // Set wagerUnitValue and wagerTotalValue, both are optional to include in the input
      $wager->wagerUnitValue = ($wagerUnitValue) ? $wagerUnitValue : $wager->wagerUnitValue;
      $wager->wagerTotalvalue = ($wagerTotalValue) ? $wagerTotalValue : $wager->wagerTotalvalue;
      $wager->save();

      $statusCode = 200;
      $value = 'application/json';
      $contents = json_encode(['message' => 'Success, wager updated']);
    }
    else
    { // Either $user or $wager couldn't be found
      $message = ($user) ? 'Error, no wager found with that id for this user' : 'Error, no user found for that id';
      $statusCode = 400;
      $value = 'application/json';
      $contents = json_encode(['message' => $message]);
    }

    $response = Response::make($contents, $statusCode);
    $response->header('Content-Type', $value);

    return $response;
  }
}
