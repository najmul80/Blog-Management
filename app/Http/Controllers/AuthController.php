<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function homePage()
    {
        $categories = Category::latest()->take(6)->get(); // Limit to 6
        $posts = Post::with('category', 'user')->latest()->take(6)->get(); // Latest 6 posts
        
        return view('welcome', compact('categories', 'posts'));
    }

    public function index()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password' => bcrypt($request->password),
        ]);
        Auth::attempt($request->only('email','password'));
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function dashboard()
    {
        $user = Auth::user()->id;
        $postCount = Post::where('user_id',$user)->count();
        $categoryCount = Category::count();
        return view('dashboard',compact('postCount','categoryCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function loginPage()
    {
        return view('auth.login');
    }

    /**
     * Update the specified resource in storage.
     */
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Login Success');
        } else {
            return redirect()->back()->with('error','login failed');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    { 
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
