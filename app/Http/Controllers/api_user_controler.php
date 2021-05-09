<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\user_image;
use Hash;
use Illuminate\Support\Facades\Auth;
class api_user_controler extends Controller
{
    public function create(Request $request)
    {
        $insert = new User;
        $insert->name = $request->input('name');
        $insert->email = $request->input('email');
        $insert->email_verified_at = $request->input('email_verified_at');
        $insert->password = Hash::make($request->input('password'));
        $insert->remember_token = $request->input('remember_token');
        
        #$validateData['password'] = bcsqrt($request->password);

        echo $insert->save();
        return response()->json($insert);
    }

    public function list()
    { 
        return User::all();
    }
    public function del($id)
    {
        $insert = User::find($id);
        $result = $insert->delete();
        if($result)
        {
            return ["result"=>"Your Data Deleted"];
        }
        else
        {
            return["result"=>"Your Data is Not Deleted"];
        }
    }

    public function edit(Request $request)
    {
        $update = User::find($request->id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->email_verified_at = $request->email_verified_at;
        $update->password = $request->password;
        $update->remember_token = $request->remember_token;
        $result = $update->save();
        if($result)
        {
            return ["result"=>"Your Data is  Updated"];
        }
        else
        {
            return ["Result"=>"Your Data is Not Updated"];
        }
    }

   public function login(Request $request)
   {
       $user = User::where('email',$request->email)->first();
       if(!$user || !Hash::check($request->password,$user->password))
       {
           return response([
               'Error'=>["Email or password is not Match"]
           ]);
       }
       return $user;
   }

   public function upload(Request $request)
   {

    $input=$request->all();
    $images = array();
    if($files=$request->file('file'))
    {
        foreach($files as $file)
        {
            $name = $file->getClientOriginalName();
            $file->move('productss',$name);
            $images[]=$name;    
        }

    }

    $image = new user_image;
    $image->image = implode(",",$images);
    $image->save(); 
   }

}
