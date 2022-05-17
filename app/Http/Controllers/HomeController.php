<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PostManagement;
use App\Models\comments;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = PostManagement::where('userId', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        foreach($post as $key => $p)
        {
            $comment[$key] = comments::where('postId', $p->id)->get();
        }

        foreach($post as $key => $p)
        {
            foreach($comment[$key] as $key1 => $c)
            {
                $commentName[$key][$key1] = User::where('id', $c->userId)->value('name'); 
            }
        }

        if($post->isEmpty())
        {
            $comment = NULL;
            $commentName = NULL;
        }

        return view('user', array(
            "posts" =>  $post,
            "comments" =>  $comment,
            "commentNames" =>  $commentName,
        ));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        if($request->description == null)
        {
            $request->description = Auth::user()->description;
        }

        $user = User::find(Auth::user()->id);

        if($request->hasfile('profilePicture'))
        {
            $dest = 'uploads/'.$user->prof_image;
            if(File::exists($dest))
            {
                File::delete($dest);
            }
            $file = $request->file('profilePicture');
            $extension = $file->getClientOriginalExtension();
            $filename = $user->email.'.'.$extension;
            $file->move('uploads/user/', $filename);
            $user->prof_image = $filename;
        }
        $user->update();

        User::where('id', Auth::user()->id)
        ->update([
                    'name' => $request->name, 
                    'description' => $request->description, 
                ]);

        return back();
    }
}
