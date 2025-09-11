<?php

namespace App\Http\Controllers;

use App\Helpers\MathCaptcha;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'math_captcha' => 'required|integer'
        ], [
            'math_captcha.required' => 'Veuillez résoudre le calcul.',
            'math_captcha.integer' => 'La réponse doit être un nombre.'
        ]);

        // Verify math captcha
        if (!$validator->fails() && !MathCaptcha::verify($request->math_captcha, 'contact')) {
            $validator->errors()->add('math_captcha', 'La réponse au calcul est incorrecte.');
        }

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez corriger les erreurs ci-dessous.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // Clear captcha after successful submission
            MathCaptcha::clear('contact');

            return response()->json([
                'success' => true,
                'message' => 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer.'
            ], 500);
        }
    }

    public function refreshCaptcha(Request $request)
    {
        $type = $request->get('type', 'default');
        $captcha = MathCaptcha::generate($type);
        return response()->json([
            'question' => $captcha['question'],
            'answer' => $captcha['answer']
        ]);
    }
}
