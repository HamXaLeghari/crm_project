<?php

namespace App\Http\Controllers;

use App\Models\AccessControl;

use App\Models\UserAccessControl;
use Exception;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AccessControlController extends Controller
{
    public function findAll(){
        return response(AccessControl::all(),200);
    }
    public function add(Request $request){

        try {
            $input = $this->validate($request, [
                "name" => "required|string",
                "description" => "required|string"
            ]);

            $accessControl = new AccessControl();

            $accessControl->fill($input);

            $accessControl->save();

            return response(["message"=>"Entity Creation Successful"],201);
        }

        catch (ValidationException|Exception $exception){

            return response(["message"=>$exception->getMessage()],400);
        }

    }


    public function update(Request $request){

        try {
            $input = $this->validate($request, [
                "id"=>"required|numeric",
                "name" => "required|string",
                "description" => "required|string"
            ]);


            $accessControl = AccessControl::query()->findOrFail($input["id"]);

            $accessControl->fill($input);

            $accessControl->save();

            return response(["message"=>"Entity Updation Successful"],200);
        }

        catch (ValidationException|ModelNotFoundException|Exception $exception){

            return response(["message"=>$exception->getMessage()],400);
        }

    }

    public function delete(Request $request){

        try {
            $input = $this->validate($request, ["id"=>"required|numeric"]);

            $accessControl = AccessControl::query()->findOrFail($input["id"]);

            $accessControl->delete();

            return response(["message"=>"Entity Deletion Successful"],200);
        }

        catch (ValidationException|Exception $exception){

            return response(["message"=>$exception->getMessage()],400);
        }

    }

}
