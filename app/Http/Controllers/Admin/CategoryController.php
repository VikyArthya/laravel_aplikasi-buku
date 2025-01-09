<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('layouts.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('layouts.pages.categories.create');
    }

// Contoh response di controller
public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = new Category();
    $category->name = $request->name;
    $category->save();

    if ($request->ajax()) {
        return response()->json([
            'success' => true
        ]);
    }

    return redirect('/categories')->with('success', 'Kategori berhasil ditambahkan');
}


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('layouts.pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        }

        return redirect('/categories')->with('success', 'Kategori berhasil diperbarui');
    }


    public function delete($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();

            if (request()->ajax()) {
                return response()->json(['success' => true]);
            }

            return redirect('/categories');
        }

        return response()->json(['success' => false]);
    }

}