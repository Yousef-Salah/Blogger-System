<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
    
        return view('dashboard.index')
                    ->with('blogs', $blogs)
                    ->with('user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create')->with([
            'blog' => new Blog,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());

        $data = $request->all();

        if($request->hasFile('poaster')){
            $poaster = $request->file('poaster');
            if($poaster->isValid()){
                $data['poaster'] = $poaster->store('blogs_poasters',['disk' => 'public']);
            } else {
                throw ValidationException::withMessages(['poaster' => 'Image Was Corrupted!!']);
            }
        }

        $data['user_id'] = Auth::id();

        Blog::create($data);

        return redirect()->route('dashboard.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($blog)
    {
        $blog = Blog::findOrFail($blog);

        return view('dashboard.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->rules());
        $blog = Blog::findOrFail($id);
        $data = $request->all();
        
        $oldPoaster = $blog->poaster;

        if($request->hasFile('poaster')) {
            if($request->file('poaster')->isValid()){
              $data['poaster'] = $request->file('poaster')->store('blogs_poasters', ['disk' => 'public']);
           } else {
               throw  ValidationException::withMessages(['poaster' => 'image was corrupted']);
           }
        } else { $data['poaster'] = $blog->poaster; }

        $blog->update($data);

        if($oldPoaster and $oldPoaster != $data['poaster']){
            Storage::disk('public')->delete($oldPoaster);
        }

        return redirect()->route('dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
    
        if($blog->deleted_at){
            $blog->forceDelete();
            Storage::disk('public')->delete($blog->poaster);
        } else {
            $blog->delete();
        }

        return redirect()->route('dashboard.index');
    }

    public function trash()
    {
        return view('dashboard.trash')->with('blogs', Blog::onlyTrashed()->get());
    }
    
    public function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);

        $blog->restore();

        return redirect()->route('dashboard.trash');
    }

    private function rules()
    {
        return [
            'title' => 'required|string|min:5|max:250',
            'description' => 'nullable|string|max:250',
            'content' => 'required|string',
            'reading_duration' => 'required|integer|min:1',
            'poaster' => 'nullable|image',
            'is_public' => 'nullable|boolean'
        ];
    }
}
