<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;

class ServiceController extends Controller
{

    public function findAllServices(){
        return response(Services::all(),200);
    }

    //Function to Add Services
    public function add(Request $request)
    {
        try{
            $ValidateData=$request->validate([
                'Name' => 'required|string',
            ]);

            $service= new Services($ValidateData);

            $service->save();
            return response()->json(['message' => 'Service Added successfully'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()],401);
        }


    }

    //Function to update Services
    public function update(Request $request,$id)
    {
        try{
            $request->validate([
                'Name' => 'required|string'
            ]);

            $service= Services::findOrFail($id);
            $service->Name=$request->input('Name');
            $service->save();
            return response()->json(['message' => 'Service Updated successfully'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()],401);
        }
    }

    //Function to Delete Services
    public function delete($id)
    {
        $service = Services::findOrFail($id);
        $service->delete();

        return response()->json(['message' => 'Service Deleted successfully'],200);
    }

}
