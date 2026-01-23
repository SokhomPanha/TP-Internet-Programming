<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $projects = Project::with ('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $about_unless(auth()->user()->can('products.create'), 403);
        return view('products.create');
    }

      public function store(Request $request)
    {
        abort_unless(auth()->user()->can('projects.create'), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('projects.index');
    }

    public function update(Request $request, Project $project)
    {
        abort_unless(auth()->user()->can('projects.update'), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index');
    }
}
