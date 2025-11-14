<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'country' => 'nullable|string|max:255',
                'destination' => 'nullable|string|max:255',
                'duration' => 'nullable|string|max:255',
                'travel_date' => 'nullable|date',
                'num_travelers' => 'nullable|integer|min:1',
                'budget' => 'nullable|string|max:255',
                'message' => 'required|string|max:2000',
                'preferences' => 'nullable|string|max:2000',
                'special_requests' => 'nullable|string|max:2000',
            ]);

            // Prepare data for storage
            $data = [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'] ?? '',
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'travel_dates' => $validated['travel_date'] ?? null,
                'number_of_travelers' => $validated['num_travelers'] ?? 1,
                'preferences' => $validated['preferences'] ?? null,
                'budget_range' => $validated['budget'] ?? null,
                'special_requests' => ($validated['special_requests'] ?? '') . 
                                     ($validated['destination'] ? ' | Destination: ' . $validated['destination'] : '') . 
                                     ($validated['duration'] ? ' | Durée: ' . $validated['duration'] : '') . 
                                     ($validated['country'] ? ' | Pays: ' . $validated['country'] : ''),
                'destinations' => $validated['destination'] ? json_encode([$validated['destination']]) : null,
                'services' => null,
                'travel_style' => null,
            ];
            
            // Store the message in preferences if preferences is empty, otherwise append to preferences
            if (empty($data['preferences'])) {
                $data['preferences'] = $validated['message'];
            } else {
                $data['preferences'] = $validated['message'] . "\n\nPréférences:\n" . $data['preferences'];
            }

            // Mark new requests as unread
            $data['is_read'] = false;
            
            QuoteRequest::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Votre demande a été enregistrée avec succès. Nous vous contacterons très bientôt.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez vérifier les champs du formulaire.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Quote request error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue. Veuillez réessayer plus tard.'
            ], 500);
        }
    }
}
