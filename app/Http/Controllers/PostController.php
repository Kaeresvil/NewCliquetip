<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\PostManagement;
use App\Models\comments;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function post(Request $request){
      
        $posts = DB::table('posts')
        ->join('users', 'posts.userId', '=', 'users.id')
        // ->join('comments', 'posts.id', '=', 'comments.postId')
        ->select('users.name','users.prof_image','posts.*')
        ->orderBy('id', 'DESC')
        ->get();
        return view('home', compact('posts')); 
       
    }

    public function comment($id){
    
        $comments = DB::table('comments')
        ->leftjoin('users', 'comments.userId', '=', 'users.id')
        ->select('comments.id','comments.comment', 'users.name','comments.userId','users.prof_image')
        ->where('comments.postId', '=', $id)
        ->get();
        return response()->json($comments);

    }

    public function delete(Request $request){
       
        $commentID = $request->input('id');
        comments::find($commentID)->delete($commentID);
  
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);


    }

    public function deleteall( $id){
       
        $postid = $id;
        dd($postid);
        comments::where('postid',$postId)->delete();
  
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);


    }

  
  
  
   public function addPost(Request $request){
      
////post a comment

       if($request->input('form') == "form2"){

        $validator = Validator::make($request->all(),[
            'comment' => ['required', 'string'],
            'postid' => ['required', ],
            
        ]);
      
        if( $validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }else{
            $comment = new comments();
            $comment->userId = \Auth::user()->id;
            $comment->postId = $request->input('postid');
            $comment->comment = $request->input('comment');
            $comment->save();


     
            return response()->json([
                    'status'=>200,
                    'comment'=>$comment->comment,
                    'id'=>$comment->id,
                    'userId'=>$comment->userId,
            ]);
     
        }  


       }
       ////Post a problem 
       else{
        // $request->validate([
        //     'title' => ['required', 'string', 'max:255', ],
        //     'post' => ['required', 'string'],
        // ]);
        $post = new PostManagement();
        $post->userId = \Auth::user()->id;
        $post->title = $request->title;
        $post->post = $request->post;

        if($post->title == null && $post->post == null){
            return redirect()->back()->with('error','Failed to add Post.');
        }else{

            if( $post->save()){
                return redirect()->back()->with('success','You added new Post.');
            }else {
                return redirect()->back()->with('error','Failed to register.');
            } 

        }
      
       }

 
        
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('searchBar');

        // Search in the title and body columns from the posts table
        $posts = PostManagement::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orwhere('post', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return view('home', compact('posts'));
    }

    
}
