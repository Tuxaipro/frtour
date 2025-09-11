<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'travel_dates' => 'nullable|string|max:255',
            'number_of_travelers' => 'required|integer|min:1',
            'destinations' => 'nullable|array',
            'destinations.*' => 'integer|exists:destinations,id',
            'services' => 'nullable|array',
            'services.*' => 'string|in:hebergement,transport',
            'travel_style' => 'nullable|string|in:culturelle,aventure,luxe,spiritualite,famille,noces',
            'special_requests' => 'nullable|string|max:1000',
            'budget_range' => 'nullable|string|max:100',
            'math_captcha' => 'required|integer',
        ]);

        // Verify captcha
        if (!\App\Helpers\MathCaptcha::verify($request->math_captcha, 'quote')) {
            return response()->json(['error' => 'Le calcul de sécurité est incorrect.'], 422);
        }

        // Convert arrays to JSON strings for storage
        $validated['destinations'] = json_encode($validated['destinations'] ?? []);
        $validated['services'] = json_encode($validated['services'] ?? []);
        
        // Remove captcha from data to store
        unset($validated['math_captcha']);

        QuoteRequest::create($validated);

        return response()->json(['message' => 'Votre demande a été enregistrée avec succès. Nous vous contacterons très bientôt.']);
    }
}
