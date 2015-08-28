<?php 
namespace App\Http\Controller;

use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

	/*
	Show the profile of user
	@param int $id
	@return Response
	*/

	public function showProfile()
	{
		return "HELLO";//view('user.profile', ['user' => User::findOrFail($id)]);
	}
}
?>