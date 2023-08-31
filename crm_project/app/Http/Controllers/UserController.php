<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\String\u;


class UserController extends Controller
{

    public function addUser(Request $request){
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
                'password' => "required|string|min:6",
                 "role_id" => "required|numeric"
            ]);

            $user = new User();
            //   $role = Role::query()->select()->where("name","=","root")->get();

            if (!Storage::disk('public')->exists("/profile_images")){
                Storage::disk('public')->makeDirectory("/profile_images");
            }

            $image_path = "";

            if ($request->exists("profile_image")){
                $image_path = Storage::disk('public')->put("/profile_images",$input["profile_image"],'public');
                unset($input["profile_image"]);
                $user->profile_image = Storage::url($image_path);
            }

            $user->fill($input);
            // $user->role_id = $role->id;
            $user->password = Hash::make($input['password']);
            //$user->is_locked = false;
            $user->save();

            $user->profile_image = url($user->profile_image);


           // $token = $user->createToken("Bearer")->accessToken;


            return response(["User"=>$user],201);
        }

        catch(ValidationException|ModelNotFoundException|Exception $exception){

            return response(["message"=>$exception->getMessage()],400);
        }
    }
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
                'password' => "required|string|min:6",
               // "role_id" => "required|numeric"
            ]);

            $user = new User();
         //   $role = Role::query()->select()->where("name","=","root")->get();

            if (!Storage::disk('public')->exists("/profile_images")){
                Storage::disk('public')->makeDirectory("/profile_images");
            }

            $image_path = "";

            if ($request->exists("profile_image")){
                $image_path = Storage::disk('public')->put("/profile_images",$input["profile_image"],'public');
                unset($input["profile_image"]);
                $user->profile_image = Storage::url($image_path);
            }


            $input["role_id"] = 2;
            $user->fill($input);
           // $user->role_id = $role->id;
            $user->password = Hash::make($input['password']);
            //$user->is_locked = false;
            $user->save();

            $user->profile_image = url($user->profile_image);


           $token = $user->createToken("Bearer")->accessToken;


            return response(["User"=>$user,"Bearer"=>$token],201);
        }

        catch(ValidationException|ModelNotFoundException|Exception $exception){

            return response(["message"=>$exception->getMessage()],400);
        }
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $token = $user->createToken("Bearer")->accessToken;

            $user->profile_image = url($user->profile_image);

            return response(["user"=>$user,"Bearer"=>$token],200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function logout()
    {
        try {
            $user = Auth::user();

            $user->token()->delete();

            return response(["message"=>"logout Successful"],200);

        }

        catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function currentUser()
    {
        if (Auth::check()){
            return response(["User"=>Auth::user()],200);
        }

        return response()->json(['message' => 'Entity Not Found'], 404);
    }



}
