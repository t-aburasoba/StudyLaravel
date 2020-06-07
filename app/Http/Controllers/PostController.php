<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use Auth;
use Carbon\Carbon;
use JD\Cloudder\Facades\Cloudder;



class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->input('date');
        if(!empty($date)){

            $posts = Post::whereDate('created_at', $date)->get();

        }else{
            $posts = Post::all();
            $posts->load('user');
        }


        return view('posts.index', compact('posts', 'date'));
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
    public function store(PostRequest $request)
    {
        $post = new Post;

        $post->title      = $request->title;
        $post->body       = $request->body;
        $post->user_id    = Auth::id();

        if ($image = $request->file('image')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            //直前にアップロードされた画像のpublicIdを取得する。
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::show($publicId, [
                'width'     => 200,
                'height'    => 200
            ]);
            $post->image_path = $logoUrl;
            $post->public_id  = $publicId;
        }

        $post->save();
        
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        // $post = Post::where('id', $id)->first();

        $post->load('user', 'comments');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(Auth::id() !== $post->user_id){
            return abort(404);
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        if(Auth::id() !== $post->user_id){
            return abort(404);
        }

        $post->title    = $request->title;
        $post->body     = $request->body;

        $post->save();

        return view('posts.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(Auth::id() !== $post->user_id){
            return abort(404);
        }

        if(isset($post->public_id)){
            Cloudder::destroyImage($post->public_id);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
