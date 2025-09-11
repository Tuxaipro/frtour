<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galerie;
use App\Models\GalerieCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalerieController extends Controller
{
    public function index(Request $request)
    {
        $query = Galerie::with('category')->orderBy('sort_order');
        
        // Filter by category if provided
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        $galerie = $query->get();
        $categories = GalerieCategory::where('is_active', true)->orderBy('sort_order')->get();
        
        return view('admin.galerie.index', compact('galerie', 'categories'));
    }

    public function create()
    {
        $categories = GalerieCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.galerie.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:galerie_categories,id',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galerie', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->get('sort_order', 0);

        Galerie::create($data);

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Image ajoutée avec succès à la galerie.');
    }

    public function show(Galerie $galerie)
    {
        return view('admin.galerie.show', compact('galerie'));
    }

    public function edit(Galerie $galerie)
    {
        $categories = GalerieCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.galerie.edit', compact('galerie', 'categories'));
    }

    public function update(Request $request, Galerie $galerie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:galerie_categories,id',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($galerie->image) {
                Storage::disk('public')->delete($galerie->image);
            }
            $data['image'] = $request->file('image')->store('galerie', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->get('sort_order', 0);

        $galerie->update($data);

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Image mise à jour avec succès.');
    }

    public function destroy(Galerie $galerie)
    {
        if ($galerie->image) {
            Storage::disk('public')->delete($galerie->image);
        }
        
        $galerie->delete();

        return redirect()->route('admin.galerie.index')
            ->with('success', 'Image supprimée avec succès.');
    }
}
