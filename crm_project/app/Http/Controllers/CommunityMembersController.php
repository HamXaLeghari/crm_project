<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityMembers;

class CommunityMembersController extends Controller
{
    public function findAllMembers(){
        return response(CommunityMembers::all(),200);
    }

    public function add(Request $request)
    {
        try{
            $ValidateData=$request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => "required|string",
                'password' => "required|string|min:6",
                'community_id' => 'required|numeric'
            ]);

            $communityMember= new CommunityMembers($ValidateData);

            $communityMember->save();
            return response()->json(['message' => 'Member Added successfully in Community'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()]);
        }
    }

    public function update(Request $request,$id)
    {
        try{
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => "required|string",
            ]);

            $communityMember= CommunityMembers::findOrFail($id);
            $communityMember->first_name=$request->input('first_name');
            $communityMember->last_name=$request->input('last_name');
            $communityMember->email=$request->input('email');
            $communityMember->save();
            return response()->json(['message' => 'Member Updated successfully'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()]);
        }
    }

    public function delete($id)
    {
        $communityMember = CommunityMembers::findOrFail($id);
        $communityMember->delete();

        return response()->json(['message' => 'Member Deleted successfully'],200);
    }
}
