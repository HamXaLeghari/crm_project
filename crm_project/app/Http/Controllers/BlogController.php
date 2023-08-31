<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Controllers\Auth;
use App\Models\Category;

class BlogController extends Controller
{
    public function findBlogs(){
        return response(Blog::all(),200);
    }

    public function add(Request $request, $id)
    {
        try{
            $ValidateData=$request->validate([
                'Title' => 'required|string',
                'Content' => 'required|string',
                'Description' => 'required|string',

            ]);

            $blog = new Blog([
                'Title' => $request->input('Title'),
                'Content' => $request->input('Content'),
                'Description' => $request->input('Description'),
 //               'user_id' => Auth::id(), // Assuming you're using Laravel's built-in authentication, required syntax
                'user_id' => 1,
                'category_id'=> $id
            ]);
            $blog->save();
            return response()->json(['message' => 'Blog Added successfully'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()],401);
        }
    }

    public function update(Request $request,$id)
    {
        try{
            $request->validate([
                'Title' => 'required|string',
                'Content' => 'required|string',
                'Description' => 'required|string',
            ]);

            $blog= Blog::findOrFail($id);
            $blog->Title=$request->input('Title');
            $blog->Content=$request->input('Content');
            $blog->Description=$request->input('Description');
            $blog->save();
            return response()->json(['message' => 'Blog Updated successfully'],200);
        }
        catch (\Exception $exception){

            return response()->json(["message"=>$exception->getMessage()],401);
        }
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json(['message' => 'Blog Deleted successfully'],200);
    }

    public function showbyCategory($id)
    {
        $category = Category::find($id); // Replace $categoryId with the actual category ID

        $blogs = $category->blogs;

        return response()->json($blogs);
    }

}
