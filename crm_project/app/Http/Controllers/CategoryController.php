<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function findAllCategories(){
        return response(Category::all(),200);
    }
    public function add(Request $request)
    {
        try{
            $ValidateData=$request->validate([
                'Name' => 'required|string',
            ]);

            $category= new Category($ValidateData);

            $category->save();
            return response()->json(['message' => 'Category Added successfully'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()]);
        }


    }

    public function update(Request $request,$id)
    {
        try{
            $request->validate([
                'Name' => 'required|string'
            ]);

            $category= Category::findOrFail($id);
            $category->Name=$request->input('Name');
            $category->save();
            return response()->json(['message' => 'Category Updated successfully'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()],401);
        }
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category Deleted successfully'],200);
    }


}
