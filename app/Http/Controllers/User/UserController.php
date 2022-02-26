<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Validator;

class UserController extends AuthController {

    public function updateUser(Request $request) {
        $data = $request->all();
        // data validation
        $validator =  Validator::make($data, [
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255'
         ]);

        //  if ($validator->fails()) {
        //     return response()->json(["message"=>"Bad Request",
        //     "errors"=>$validator->errors()], 400);
        // } 
        // //  Store data in database
        // Contact::create($data);
        // // return
        // return response()->json(["message"=>"Contact Message Sent"], 200);
    }
}

// public function profileUpdate(Request $request){
//     //validation rules

//     $request->validate([
//         'name' =>'required|min:4|string|max:255',
//         'email'=>'required|email|string|max:255'
//     ]);
//     $user =Auth::user();
//     $user->name = $request['name'];
//     $user->email = $request['email'];
//     $user->save();
//     return back()->with('message','Profile Updated');
// }