<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(6);
        return view('posts.index', compact('posts', 'category'));
    }
}
