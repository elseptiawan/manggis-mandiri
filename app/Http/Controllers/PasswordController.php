<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class PasswordController extends Controller
{
    public function index()
    {
        return view('Page.Password.index');
    }

    public function edit()
    {
        return view('Page.Password.edit');
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => 'required|string|same:confirm_password',
            'confirm_password' => 'required|string',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $data = User::findOrFail(auth()->user()->id);
        if (!Hash::check($request->old_password, $data->password)) {
            return redirect()->back()->with('error', 'Password Lama Tidak Sesuai');
        }
        $data->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diganti');
    }
}
