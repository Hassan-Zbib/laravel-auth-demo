<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use JWTAuth;

class UserController extends Controller {

    protected $user;
    
    public function updateUser(Request $request) {
        $this->user = JWTAuth::parseToken()->authenticate();
        $data = $request->all();
        // data validation
        $validator =  Validator::make($data, [
            'name' => 'sometimes|required|string|between:2,100',
            'email' => 'sometimes|required|string|email|max:100|unique:users',
            'password' => 'sometimes|required|string|min:6',
         ]);

         if ($validator->fails()) {
            return response()->json(["message"=>"Bad Request",
            "errors"=>$validator->errors()], 400);
        }; 

        // update user
        $this->user->name = isset($data['name']) ? $data['name'] : $this->user->name;
        $this->user->email = isset($data['email']) ? $data['email'] : $this->user->email;
        $this->user->password = isset($data['password']) ? bcrypt($data['password']) : $this->user->password;
        $this->user->save();

        return response()->json(["message"=>"User Updated"], 200);
    }
}