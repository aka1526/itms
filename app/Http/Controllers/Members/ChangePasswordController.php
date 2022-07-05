<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

class ChangePasswordController extends Controller
{
    public function edit(Request $request)
    {

        $user = auth()->user();
        return view('profile.changepassword', ['dataset' => $user]);

    }
    public function update(Request $request)
    {


        $this->validate($request, [

            'new_password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $user = auth()->user();
        $user->update(
            ['password' => Hash::make($request->new_password)]
        );
        return back();

    }
}
