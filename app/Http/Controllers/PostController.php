<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Faker\Core\File as CoreFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Categories = Category::all();
        return view('createPost', compact('Categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $fileName = time() . '_' . $request->ImageName->getClientOriginalName();
        $filePath = $request->ImageName->storeAS('images', $fileName);
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->image = $filePath;
        $post->save();
        return redirect()->route('posts.index');


        // return $filePath;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findorfail($id);
        return view('showPost', compact('post'));
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
        $Categories = Category::all();
        // return $post;
        return view('editPost', compact('post', 'Categories'));
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
        $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
            'description' => 'required',
        ]);
        $post = Post::findorfail($id);
        if ($request->hasFile('ImageName')) {
            $request->validate([
                'ImageName' => ['required', 'image'],
            ]);

            $fileName = time() . '_' . $request->ImageName->getClientOriginalName();
            $filePath = $request->ImageName->storeAS('images', $fileName);
            File::delete(public_path('storage/' . $post->image));
            $post->image = $filePath;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findorfail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
    public function trashed()
    {

        $posts = Post::onlyTrashed()->get();
        // dd($posts->title);
        // dd($posts);
        return view('trashed', compact('posts'));
    }
    public function restore($id)
    {
        $post=Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('posts.index');
    }
    public function ForceDelete($id)
    {
        # code...
        $post=Post::onlyTrashed()->findOrFail($id);
        File::delete(public_path('storage/' . $post->image));
        $post->forceDelete();
        return redirect()->back();
    }
}
