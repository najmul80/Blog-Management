<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Display a listing of posts
    public function index()
    {
        $user = Auth::user()->id;
        $posts = Post::where('user_id',$user)->with('category', 'user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Show the form for creating a new post
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // Store a newly created post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|min:3|unique:posts,title',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048|',
        ]);

        $path = null;
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalName();
        
            // Store the file with the unique name
            $path = 'uploads/'.$filename;
            $image->move(public_path('uploads'), $filename);
        }

        Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
            'user_id'=>$request->user_id,
            'featured_image'=>$path,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Display the specified post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // Update the specified post
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $request->validate([
            // 'title' => 'required|string|max:255|min:3|unique:posts,title'.$post->id,
            'title' => 'required|min:3|max:255|string|unique:posts,title,' . $post->id,
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048|',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if($post->featured_image && file_exists(public_path($post->featured_image))){
                unlink(public_path($post->featured_image));
            }
            $image = $request->file('featured_image');
            $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalName();
        
            // Store the file with the unique name
            $path = 'uploads/'.$filename;
            $image->move(public_path('uploads'), $filename);
        }


        $post->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
            'user_id'=>$request->user_id,
            'featured_image'=> isset($path) ? $path : $post->featured_image,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Remove the specified post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->featured_image && file_exists(public_path($post->featured_image))){
            unlink(public_path($post->featured_image));
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
