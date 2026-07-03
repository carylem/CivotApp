<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Project;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Project $project)
    {
        if ($project->statut !== 'actif') {
            return back()->with('error', 'Projet inactif');
        }

        $exists = Vote::where('user_id', auth()->id())
            ->where('project_id', $project->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Vous avez déjà voté');
        }

        Vote::create([
            'user_id' => auth()->id(),
            'project_id' => $project->id
        ]);

        return back()->with('success', 'Vote enregistré');
    }
}