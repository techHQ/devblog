<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;

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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Posts = Post::orderBy('created_at','DESC')->take(4)->get();
        //    $Posts = Post::all();
        // $Posts = Post::orderBy('created_at','DESC')->get();
        $Posts = Post::orderBy('created_at','DESC')->paginate(2);
        return view('posts.index')->with('Posts',$Posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        // return Validator::make($request, [
        //     'title' => 'required|string|max:255',
        //     'body' => 'required',
        //     'cover_image' => 'image|nullable|max:1999',
        // ]);

        if($request->hasFile('cover_image')){
            //getfile name with extenssion
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension 
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension ;
            //upload images
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }else{

            //filename to store
            $filenameToStore = 'noimage.jpg';
        }


        
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post created successfully');
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::find($id);
        return view('posts.show')->with('posts',$posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
       
        //check for correct user
        if(auth()->user()->id !== $posts->user_id){
       
            return redirect('/posts')->with('error','unathorized Page ');

        }

       
        return view('posts.edit')->with('posts',$posts);
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
        
         if($request->hasFile('cover_image')){
            //getfile name with extenssion
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension 
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension ;
            //upload images
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }    
        $post = Post::find($id)->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            // 'cover'=>$request->input('')
        ]);
        // if($request->hasFile('cover_image')){
        //     $post->cover_image = $filenameToStore;
        //     }
      if($post){
        return redirect('/posts')->with('success','Post updated');
      }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $posts = Post::find($id);
        
       //check for correct user
        if(auth()->user()->id !== $posts->user_id){
       
            return redirect('/posts')->with('error','unathorized Page ');

        }

        if($posts->cover_image != 'noimage.jpg'){
            //dekete image
            Storage::delete('public/cover_images/'.$posts->cover_image);

        }
       $posts->delete();

       return redirect('/posts')->with('success','post deleted');
    }
}
