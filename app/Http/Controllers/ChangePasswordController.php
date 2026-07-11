<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword()
    {
        return view('change-password.index');
    }

    public function updatePassword(Request $request)
    {
        $request->validate(
        [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(auth()->id());
        
        $old_password = auth()->user()->password;
        

        if (Hash::check($request->old_password, $old_password)) 
        {

            if (!Hash::check($request->password, $old_password)) 
            {
                $user->password = Hash::make($request->password);
                $user->save();
                
                return back()->with('success_msg','Password updated Successfully');
            } 
            else 
            {
                
                return back()->with('error_msg','New password cannot be the old password!');
            }

        } else {
            
            return back()->with('error_msg','old password doesnt match');
        }
    
    }


}
