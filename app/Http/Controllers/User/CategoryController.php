<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::where('user_id', auth()->user()->id)->get();
            return Inertia::render('user/category/index', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error loading categories: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load categories.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('user/category/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:12',
            'icon' => 'required'
        ]);

        try {

            $validated['user_id'] = auth()->user()->id;

            Category::create($validated);
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return Inertia::render('user/category/edit', compact('category'));
        } catch (\Exception $e) {
            Log::error('Error loading category for edit: ' . $e->getMessage());
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:12',
            'icon' => 'required'
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->update($validated);

            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update category.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete category.');
        }
    }
}
