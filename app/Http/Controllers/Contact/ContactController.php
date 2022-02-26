<?php
namespace App\Http\Controllers\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Validator;

class ContactController extends Controller {

    public function addContact(Request $request) {
        $data = $request->all();
        // data validation
        $validator =  Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:8',
            'subject'=>'required',
            'message' => 'required'
         ]);

         if ($validator->fails()) {
            return response()->json(["message"=>"Bad Request",
            "errors"=>$validator->errors()], 400);
        } 
        //  Store data in database
        Contact::create($data);
        // return
        return response()->json(["message"=>"Contact Message Sent"], 200);
    }
}