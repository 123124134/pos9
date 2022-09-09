<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function destroy($id)
  {

    $users = User::find($id);
    if (!$users) {
      return back()->with('Error', 'User not Found');
    }
    $users->delete();
    return back()->with('Success', 'User Deleted successfully!');
  }

  public function update(Request $request)
  {
    $users = User::find($request->id);
    if (!$users) {
      return back()->with('Error', 'User not Found');
    }
    $users->update($request->all());
    return back()->with('Success', 'User Update successfully!');
  }
  public function index()
  {
    $users = User::paginate(5);

    return view('users.index', ['users' => $users]);
  }

  public function store(Request $request)
  {
    $users = new user;
    $users->name = $request->name;
    $users->phone = $request->phone;
    $users->email = $request->email;
    $users->password = md5($request->name);
    $users->is_admin = $request->is_admin;
    $users->save();
    if ($users) {
      return redirect()->back()->with('User Created Successfully');
    }
    return redirect()->back()->with('User Fail Created');
  }
}
