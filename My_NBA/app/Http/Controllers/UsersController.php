<?php
# @Author: alex
# @Date:   2017-12-08T08:20:33-05:00
# @Last modified by:   alex
# @Last modified time: 2017-12-22T05:55:41-05:00

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class UsersController extends Controller
{
  public function checkAdmin(){
    if (Auth::check() && Auth::user()->status==0)
    {
      return 0;
    }
    else if (Auth::check() && Auth::user()->status==1)
    {
      return 1;
    }
    else
    {
      return 9;
    }
  }

  public function ShowUsers(){
    $admin = $this->checkAdmin();
    if ($admin != 1)
    {
      return redirect('/login');
    }
    else
    {
      $users = User::all();
      return view('users',[
        'users' => $users,
      ]);
    }
  }

  public function ShowUser($id) {
    $user = User::find($id);
    return view('edituser',[
      'user' => $user,
    ]);
  }

  public function addUser(Request $request)
  {
    if ($request->isMethod('post'))
    {
      request()->validate([
        'name'=>['required','min:3'],
        'email'=>['required','email'],
        'password'=>['required','confirmed', 'min:6'],
      ]);

      $user = User::create([
        'name'=> request('name'),
        'email' => request('email'),
        'password' => bcrypt(request('password')),
        'status' => request('status'),
      ]);
    }
    return view('adduser');
  }

  public function editUser(Request $request, $id)
  {
    $admin = $this->checkAdmin();
    if ($admin != 1)
    {
      return redirect('/login');
    }
    else
    {
      if ($request->isMethod('post'))
      {
        request()->validate([
          'name'=>['required','min:3'],
          'email'=>['required','email'],
          'password'=>['required','confirmed', 'min:6'],
        ]);
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->status = request('status');
        $user->save();
      }
      $user = User::find($id);
      return view('edituser',[
        'user' => $user,
        'admin' => $admin,
      ]);
    }
  }

  public function delete($id){
    $user = User::find($id);
    $user->delete();
    return redirect('users');
  }
}
