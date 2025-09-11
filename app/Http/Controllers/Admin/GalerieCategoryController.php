<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalerieCategory;
use Illuminate\Http\Request;

class GalerieCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = GalerieCategory::orderBy('sort_order')->get();
        return view('admin.galerie-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galerie-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->get('sort_order', 0);

        GalerieCategory::create($data);

        return redirect()->route('admin.galerie-category.index')
            ->with('success', 'Catégorie ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GalerieCategory $galerieCategory)
    {
        return view('admin.galerie-category.show', compact('galerieCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalerieCategory $galerieCategory)
    {
        return view('admin.galerie-category.edit', compact('galerieCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalerieCategory $galerieCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->get('sort_order', 0);

        $galerieCategory->update($data);

        return redirect()->route('admin.galerie-category.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalerieCategory $galerieCategory)
    {
        // Check if category has galeries
        if ($galerieCategory->galeries()->count() > 0) {
            return redirect()->route('admin.galerie-category.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des images.');
        }

        $galerieCategory->delete();

        return redirect()->route('admin.galerie-category.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
