<?php

namespace App\Http\Controllers;

use App\Models\AccessControl;
use App\Models\User;
use App\Models\UserAccessControl;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserAccessControlController extends Controller
{

    public function findAll(){
        return response(UserAccessControl::all(),200);
    }

    public function findByCurrentUser(){
        try {
            $uacl = UserAccessControl::query()
                ->where("user_id","=",Auth::id())
                ->with(["user","accessControl"])
                ->get();

            return response($uacl,200);
        }

        catch (ModelNotFoundException|Exception $exception){
            return response(["message"=> $exception->getMessage()],400);
        }
    }

    public function assign(Request $request){

        try {
            $input = $this->validate($request, [
                "access_control_id" => "required|numeric",
                "user_id"=>"required|numeric"
            ]);

            AccessControl::query()->findOrFail($input["access_control_id"]);
            User::query()->findOrFail($input["user_id"]);

            $userAccessControl = new UserAccessControl();

            $userAccessControl->fill($input);

            $userAccessControl->save();

            return response(["message"=>"Entity Creation Successful"],200);
        }

        catch(ValidationException|Exception $exception){
            return response(["message"=>$exception->getMessage()],200);
        }

    }

    public function unassign(Request $request){

        try {
            $input = $this->validate($request, ["id" => "required|numeric"]);

            $userAccessControl = UserAccessControl::query()->findOrFail($input["id"]);

            $userAccessControl->delete();

            return response(["message"=>"Entity Deletion Successful"],200);
        }

        catch(ValidationException|ModelNotFoundException|Exception $exception){
            return response(["message"=>$exception->getMessage()],200);
        }

    }
}
