<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('categories.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255|unique:categories,name',
        ]);
    
        Category::create($request->only('name'));
    
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return redirect()->route('categories.index');
    }
        
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }
    
    public function update(Request $request, string $id)
    {
         
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|min:3|max:255|unique:categories,name,' . $category->id,
        ]);
    
        $category->update($request->only('name'));
    
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }

    
}
