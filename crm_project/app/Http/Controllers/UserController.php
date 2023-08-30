<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function signup(Request $request){

        try {
            $input = $this->validate($request, [
                'first_name' => "required|string",
                "last_name" => "required|string",
                "age" => "required|numeric",
                'email' => "required|string",
                "phone" => "required|string",
                "profile_image" => "sometimes|image|mimes:jpg,jpeg,png",
                "bio" => "required|string",
                "description" => "required|string",
                'password' => "required|string",
                "role_id" => "required|numeric"
            ]);

            $user = new User();
            $user->fill($input);
            $user->is_locked = false;
            $user->save();

            return response(["message"=>"User Created Successfully"],201); // need to implement a JWT response here
        }

        catch(ValidationException|Exception $exception){

            return response(["message"=>$exception->getMessage()],400);
        }
    }
}
