<?php

namespace App\Http\Controllers;

use App\Models\UserAccessControl;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserAccessControlController extends Controller
{
    public function assign(Request $request){

        try {
            $input = $this->validate($request, [
                "user_id" => "required|numeric",
                "access_control_id" => "required|numeric"
            ]);

            $userAccessControl = new UserAccessControl();

            $userAccessControl->fill($input);

            $userAccessControl->save();

            return response(["message"=>"Entity Deletion Successful"],200);
        }

        catch(ValidationException|Exception $exception){
            return response(["message"=>$exception->getMessage()],200);
        }

    }

    public function unassign(Request $request){

        try {
            $input = $this->validate($request, ["user_access_control_id" => "required|numeric"]);

            $userAccessControl = UserAccessControl::query()->findOrFail($input["id"]);

            $userAccessControl->delete();

            return response(["message"=>"Entity Deletion Successful"],200);
        }

        catch(ValidationException|ModelNotFoundException|Exception $exception){
            return response(["message"=>$exception->getMessage()],200);
        }

    }
}
