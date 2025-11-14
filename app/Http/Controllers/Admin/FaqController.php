<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $faqs = $query->orderBy('sort_order')->paginate(20)->withQueryString();
        
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        $nextSortOrder = (Faq::max('sort_order') ?? 0) + 1;
        return view('admin.faq.create', compact('nextSortOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        // Auto-increment sort_order if not provided
        if (!isset($data['sort_order']) || $data['sort_order'] === null || $data['sort_order'] === '') {
            $maxSortOrder = Faq::max('sort_order') ?? 0;
            $data['sort_order'] = $maxSortOrder + 1;
        } else {
            $data['sort_order'] = (int)$data['sort_order'];
        }

        Faq::create($data);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ ajoutée avec succès.');
    }

    public function show(Faq $faq)
    {
        return view('admin.faq.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->get('sort_order', 0);

        $faq->update($data);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ mise à jour avec succès.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ supprimée avec succès.');
    }
}
