<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use App\Models\Interaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('author')->withOutGlobalScope('user_id')
                            ->orderBy('created_at', 'desc')
                            ->paginate(7);
        
        return view('blogs.index')->with([
            'blogs' => $blogs,
            'title' => 'LATEST BLOGS',
            'active' => 'latest',
            'search' => ''
        ]);
    }

    public function search(Request $request)
    {
        $blogs = Blog::withOutGlobalScope('user_id')
                        ->where('title', 'like','%' . $request->post('search') . '%')
                        ->paginate(7);

        $search = $request->post('search');

        return view('blogs.index', [
            'blogs' => $blogs,
            'title' => "Search about: " . $search,
            'active' => 'latest',
            'search' => $search
        ]);

    }
    public function topRated()
    {
        $blogs = Blog::with('author')->withOutGlobalScope('user_id')
                            ->orderBy('total_likes', 'desc')
                            ->limit(20)
                            ->paginate(7);
                         
        //dd($blogs);
        return view('blogs.index')->with([
            'blogs' => $blogs,
            'title' => 'TOP RATED BLOGS',
            'active' => 'top-rated',
            'search' => ''
        ]);
    }

    public function show($id)
    {
        $blog = Blog::with('comments')->with('author')->withOutGlobalScope('user_id')->findOrFail($id);
        if(Auth::user()){
           $status = $blog->interactionStatus(Auth::user()->id);
        } else { $status = ''; }
        $active = null;
        $search = '';
        return view('blogs.show', compact('blog', 'status', 'active', 'search'));
    }

    public function newComment(Request $request, $blogID)
    {
        $blog = Blog::withOutGlobalScope('user_id')->findOrFail($blogID);
                
        $request->validate([
            'comment' => 'required|string|min:5|max:2000'
        ]);

        Comment::create([
            'comment' => $request->post('comment'),
            'user_id' => Auth::user()->id,
            'blog_id' => $blog->id,
        ]);

        $blog->total_comments++;
        $blog->save();
        

        return redirect()->route('blogs.show', $blog->id);
    }

    public function like(Request $request, $blogID)
    {
        $request->validate([
            'like_status' => 'nullable|string|in:like,dislike',
        ]);

        
        
        $blog = Blog::withOutGlobalScope('user_id')->findOrFail($blogID);

        $interactionStatus = $blog->interactionStatus(Auth::user()->id);
        $interaction = $request->post('interaction');
        $userID = Auth::user()->id;

        if(!$interactionStatus) { // if not interactes save new record for this user.
            Interaction::create([
                'user_id' => $userID,
                'blog_id' => $blogID,
                'interaction' => $request->post('interaction'),
            ]);

            if($interaction == 'like'){
                $blog->total_likes++;
            } else { $blog->total_dislikes++; }

            
        } else if($interaction === $interactionStatus) {
            //dd('delete');
            Interaction::where('user_id', '=', $userID)
                       ->where('blog_id', '=', $blogID)
                       ->delete();

            if($interaction == 'like'){
            $blog->total_likes--;
            } else { $blog->total_dislikes--; }

        } else {
            //dd("update");
            Interaction::where('user_id', '=', $userID)
                        ->where('blog_id', '=', $blogID)
                        ->update(['interaction' => $interaction]);
            
            if($interaction == 'like') {
                $blog->total_likes++;
                $blog->total_dislikes--; 
            } else {
                $blog->total_likes--;
                $blog->total_dislikes++; 
            }
        }

        
        $blog->save();

        return redirect()->back();
    }
}
