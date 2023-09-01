<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;

use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    //
    public function findAllCommunities(){
        return response(Community::all(),200);
    }

    public function add(Request $request)
    {
        try{
            $ValidateData=$request->validate([
                'Name' => 'required|string',
            ]);

            $community = new Community([
                'Name' => $request->input('Name'),
                'user_id' => Auth::id(), // Assuming you're using Laravel's built-in authentication, required syntax
                //'user_id' => 1

            ]);
            $community->save();
            return response()->json(['message' => 'Community Added successfully'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()],401);
        }
    }

    public function update(Request $request,$id)
    {
        try{
            $request->validate([
                'Name' => 'required|string'
            ]);

            $community= Community::findOrFail($id);
            $community->Name=$request->input('Name');
            $community->save();
            return response()->json(['message' => 'Community Updated successfully'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()],401);
        }
    }

    public function delete($id)
    {
        $community = Community::findOrFail($id);
        $community->delete();

        return response()->json(['message' => 'Community Deleted successfully'],200);
    }

}
