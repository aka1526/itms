<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function edit(Request $request){

       // $uuid=$request->fa_uuid;

        return  view('profile.edit',['dataset'=>auth()->user()]);


    }
    public function update(Request $request){
        $user =auth()->user();
         $this->validate($request,[
                'name'=>'required|max:255'
                ,'email'=>'required|max:255'
         ]);
         $user->update(
            $request->only('name','email')
         );
        return  back();


    }


}
