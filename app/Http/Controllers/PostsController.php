<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$posts =  Post::orderBy('title','asc')->get();
        $posts = DB::select('SELECT * FROM posts');
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just Filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get Ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('/cover_images',$fileNameToStore,'public');
        }
        else{
            $fileNameToStore = 'noImage.jpeg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post =  Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','You do not have permission to edit this post.');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just Filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get Ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('cover_image')->storeAs('/cover_images',$fileNameToStore,'public');
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success','Post created.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','You do not have permission to edit this post.');
        }

        if($post->cover_image!=='noImage.jpeg'){
            Storage::disk('public')->delete('cover_images/' . $post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Post deleted.');
    }
}
