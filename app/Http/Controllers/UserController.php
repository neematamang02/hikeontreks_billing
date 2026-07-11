<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        
        return view('user.create');
    }

    public function store(Request $request)
    {
        request()->validate([
			'name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:8',
			'role' => 'required|in:user,admin',
		]);
		$email=$request->email;
		if(User::where('email',$email)->exists())
        {
			return redirect()->back()->with('error_msg','Email must be unique');
		}
		else{
			$user=new User();
			$user->name=$request->name;
			$user->email=$request->email;
			$user->password=Hash::make($request->password);
			$user->role=$request->role;
			$user->save();
			return redirect()->route('user.index')->with('success_msg','User added successfully');
		}
    }

    public function index()
    {
        $user=User::all();
        return view('user.index',compact('user'));
    }

    public function edit($id)
    {
		$user = User::findOrFail($id);

		return view('user.edit', compact('user'));

    }

    public function update(Request $request,$id)
    {
        request()->validate([
			'name' => 'required',
			'email' => 'required|email|unique:users,email,' . $id,
			'role' => 'required|in:admin,user',
		]);
		
		$useredit = User::findOrFail($id);
		$useredit->name=$request->name;
		
		$useredit->email=$request->email;
		
		$useredit->role=$request->role;

		$useredit->update();
		return redirect()->route('user.index')->with('success_msg','Users Updated Successfully');
    }

	public function resetPassword($id)
	{
		$user_id = User::findOrFail($id);
		return view('user.reset-password', compact('user_id'));
	}

	public function reset(Request $request,$id)
	{
		
		request()->validate([
			'password' => 'required|min:8',
		]);

		$reset = User::findOrFail($id);
		$reset->password= Hash::make($request->password);
		$reset->save();
		
		return redirect()->route('user.index')->with('success_msg','Password was reset successfully');
	}
}
