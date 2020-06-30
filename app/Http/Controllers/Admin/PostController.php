<?php

namespace App\Http\Controllers\Admin;

use App\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use App\Mail\NewPost;
use App\Mail\UpdatedPost;
use Illuminate\Support\Facades\Mail;


class PostController extends Controller
{

    // ADMIN USERS

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate($this->valiationRules());

        // request data
        $data = $request->all();

        $data['user_id'] = Auth::id();

        $data['slug'] = Str::slug($data['title'], '-');

        // save image
        if (!empty($data['path_img'])) {
            $data['path_img'] = Storage::disk('public')->put('images', $data['path_img']);
        }

        $newPost = new Post();
        $newPost->fill($data);
        $saved = $newPost->save();

        if($saved) {

            Mail::to('user@test.com')->send(new NewPost($newPost));

            return redirect()->route('admin.posts.show', $newPost->id);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // validation
        $request->validate($this->valiationRules());

        $data = $request->all();

        $data['slug'] = Str::slug($data['title'], '-');

        // edit image
        if(!empty($data['path_img'])) {

            // delete prev image
            if(!empty($post->path_img)) {
                Storage::disk('public')->delete($post->path_img);
            }

            // add new image
            $data['path_img'] = Storage::disk('public')->put('images', $data['path_img']);
        }

        $updated = $post->update($data);

        if($updated) {

            Mail::to('user@gmail.com')->send(new UpdatedPost($post));

            return redirect()->route('admin.posts.show', $post->id);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(empty($post)) {
            abort('404');
        }

        $title = $post->title;

        $deleted = $post->delete();

        if($deleted) {

            //remove img    
            if(!empty($post->path_img)) {
                Storage::disk('public')->delete($post->path_img);
            }

            return redirect()->route('admin.posts.index')->with('post-deleted', $title);
        }
    }

    /**
     * Validation rules
    */

    private function valiationRules() 
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'path_img' => 'image'
        ];
    }
}
