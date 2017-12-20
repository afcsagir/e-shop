<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	public function getUsers()
	{
		$users = DB::table('users')->get();
		$count = count($users);

		return view('all-customers',['users' => $users, 'count' => $count]);
	}







}