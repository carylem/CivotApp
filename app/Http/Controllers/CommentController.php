<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $count = Comment::where('user_id', auth()->id())
            ->where('created_at', '>=', now()->subHour())
            ->count();

        if ($count >= 3) {
            return response()->json([
                'message' => 'Limite de 3 commentaires par heure atteinte'
            ], 429);
        }

        $request->validate([
            'content' => 'required|min:10|max:500'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'project_id' => $project->id,
            'content' => $request->content
        ]);

        return back()->with('success', 'Commentaire ajouté');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Commentaire supprimé');
    }
}