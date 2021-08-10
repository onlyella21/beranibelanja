<?php

namespace App\Http\Controllers;

use App\Models\{Category, Post, Tag};
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class PostController extends Controller
{
    
    public function index()
    {
        
        return view('posts.index',[
            'posts' => Post::latest()->paginate(4),
        ]);
    }
    public function show(Post $post)
    {
        $posts = Post::where('category_id', $post->category_id)->latest()->limit(6)->get();
        
        return view('posts.show', compact('post', 'posts'));
    }

    public function create()
    {
        return view('posts.create', [
            'post'=> new Post(),
            'categories'=>Category::get(),
            'tags'=>Tag::get(),
            ]);
    }

    

    public function store(PostRequest $request)
    {
        $request->validate([
            'thumbnail'=>'img|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $attr = $request->all();
        $slug = Str::slug(request('title'));
        $attr['slug'] =$slug; 

        $thumbnail =request()->file('thumbnail') ? request()->file('thumbnail')->store("images/posts") : null;
            
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;
        //cara menyimpan post ke database
        $post = auth()->user()->posts()->create($attr);
        
        $post->tags()->attach(request('tags'));

        //membuat notifikasi data berhasil disimpan
        session()->flash('success', 'The post was created');
        // session()->flash('error','The Post cannot be created');
        
        return redirect('posts');
        // return back();

        //cara menyimpan ke database ke 1
        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = \Str::slug($request->title);s
        // $post->body = $request->body;
        // $post->save();
        //return redirect()->to('posts/create');

        //cara menyimpan ke database ke 2
        // Post::create([
        //     'title'=>$request->title,
        //     'slug'=>\Str::slug($request->title),
        //     'body'=>$request->body,

        // ]);
        
        //cara 1 buat valdasi data
        // $attr =$this->validateRequest();
        //cara 2 membuat PostRequest : php artisan make:request PostRequest
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }

    public function update(PostRequest $request,Post $post)
    {
        $request->validate([
            'thumbnail'=>'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $this->authorize('update', $post);
        if(request()->file('thumbnail')){
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/posts");
        } else{
            $thumbnail = $post->thumbnail;
        }

        $attr = $request->all();
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        $post->update($attr);
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'The post was updated');
        return redirect('posts');
    }

   public function destroy(Post $post)
   {
        $this->authorize('delete', $post);

        \Storage::delete($post->thumbnail);

            $post->tags()->detach();
            $post->delete();
            session()->flash("success", "The post was deleted");
            return redirect('posts');

        session()->flash('error','This post is was not your post');
        return redirect('posts');

        // if(auth()->user()->is($post->author)){
            
        // }else {
        //     session()->flash("error", "It wasn't your post");
        //     return redirect('posts');
        // }  
   } 
   
}
