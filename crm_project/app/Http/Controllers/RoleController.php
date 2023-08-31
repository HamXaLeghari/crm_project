<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{

    public function findAll(){

        return response(Role::all(),200);
    }

    /**
     * @throws ValidationException
     */
    public function findByName(Request $request){

       $input = $this->validate($request,[
            "name"=>"required|string"
        ]);

        $role = Role::query()->select()->where("role.name","=",$input["name"]);

        if ($role->exists()) {return response($role->get(), 200);}

        return response("Resource Not Found",404);
    }

    /**
     * @throws ValidationException
     */
    public function findById(Request $request){

        $input = $this->validate($request,[
            "id"=>"required|numeric"
        ]);
        return response(Role::query()->findOrFail($input["id"]),404);
    }
   public function add(Request $request){

       try {
           $input = $this->validate($request, [
               "name" => "required|string",
               "description" => "required|string"
           ]);

           $role = new Role();

           $role->fill($input);

           $role->save();

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

            $role = Role::query()->findOrFail($input["id"]);

            $role->fill($input);

            $role->save();

            return response(["message"=>"Entity Updation Successful"],200);
        }

        catch (ValidationException|ModelNotFoundException|Exception $exception){

            return response(["message"=>$exception->getMessage()],400);
        }

    }

    public function delete(Request $request){

        try {
            $input = $this->validate($request, ["id"=>"required|numeric"]);

            $role = Role::query()->findOrFail($input["id"]);

           $role->delete();

            return response(["message"=>"Entity Deletion Successful"],200);
        }

        catch (ValidationException|Exception $exception){

            return response(["message"=>$exception->getMessage()],400);
        }

    }


}
