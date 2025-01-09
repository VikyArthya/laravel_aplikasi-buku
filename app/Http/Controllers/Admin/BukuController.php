<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all(); // Ambil semua kategori
        $bukus = Buku::with('category');

        // Cek apakah ada filter kategori
        if ($request->has('category') && $request->category != '') {
            $bukus->where('category_id', $request->category);
        }

        return view('layouts.pages.buku.index', [
            "bukus" => $bukus->get(),
            "categories" => $categories,
        ]);
    }


    public function create()
    {
        $categories = Category::all();

        return view('layouts.pages.buku.create', [
            "categories" => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = new Buku();
        $book->name = $request->input('name');
        $book->category_id = $request->input('category_id');

        // Handle file upload
        if ($request->hasFile('path')) {
            $imagePath = $request->file('path')->store('bukus', 'public');
            $book->path = $imagePath;
        }

        $book->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        }

        return redirect('/bukus')->with('success', 'Buku berhasil ditambahkan');
    }


    public function edit($id)
    {
        $categories = Category::all();
        $buku = Buku::findOrFail($id);

        return view('layouts.pages.buku.edit', [
            "categories" => $categories,
            "buku" => $buku,
        ]);
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $book = Buku::findOrFail($id);
    $book->name = $request->input('name');
    $book->category_id = $request->input('category_id');

    // Handle file upload
    if ($request->hasFile('path')) {
        // Hapus gambar lama jika ada
        if ($book->path) {
            Storage::delete('public/' . $book->path);
        }

        $imagePath = $request->file('path')->store('bukus', 'public');
        $book->path = $imagePath;
    }

    $book->save();

    if ($request->ajax()) {
        return response()->json([
            'success' => true
        ]);
    }

    return redirect('/bukus')->with('success', 'Buku berhasil diperbarui');
}


public function delete($id)
{
    $buku = Buku::find($id);

    if ($buku) {
        $buku->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect('/bukus');
    }

    return response()->json(['success' => false]);
}

}