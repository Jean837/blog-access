<?php
namespace App\Http\Controllers;

use App\Models\Waitlist;
use Illuminate\Http\Request;

class WaitlistController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'email'  => 'required|email',
            'name'   => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
        ]);

        if (Waitlist::where('email', $request->email)->exists()) {
            return back()->with('waitlist_info', 'Vous êtes déjà sur la liste d\'attente !');
        }

        Waitlist::create($request->only('email', 'name', 'region'));

        return back()->with('waitlist_success', 'waitlist_success');
    }

    // Retourne le nombre d'inscrits en JSON (pour le compteur live)
    public function count() {
        return response()->json([
            'count' => Waitlist::count()
        ]);
    }
}