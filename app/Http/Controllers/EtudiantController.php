<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    // Afficher tous les étudiants
    public function index()
    {
        $etudiants = Etudiant::all();

        return response()->json($etudiants);
    }

    // Enregistrer un étudiant
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'filiere' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
        ]);

        $etudiant = Etudiant::create($validated);

        return response()->json([
            'message' => 'Étudiant créé avec succès',
            'data' => $etudiant
        ], 201);
    }

    // Afficher un seul étudiant
    public function show(Etudiant $etudiant)
    {
        return response()->json($etudiant);
    }

    // Modifier un étudiant
    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,' . $etudiant->id,
            'filiere' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
        ]);

        $etudiant->update($validated);

        return response()->json([
            'message' => 'Étudiant modifié avec succès',
            'data' => $etudiant
        ]);
    }

    // Supprimer un étudiant
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return response()->json([
            'message' => 'Étudiant supprimé avec succès'
        ]);
    }
}
