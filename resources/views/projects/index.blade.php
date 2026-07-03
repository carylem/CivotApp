<x-app-layout>

    <div class="max-w-4xl mx-auto py-6">

        <h1 class="text-2xl font-bold mb-6">
            Liste des projets
        </h1>

        {{-- MESSAGES --}}
        @if(session('success'))
            <div class="bg-green-200 p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 p-2 mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- PROJETS --}}
        @foreach($projects as $project)
            <div class="border p-4 mb-4 rounded">

                <h2 class="text-xl font-semibold">
                    {{ $project->titre }}
                </h2>

                <p class="text-gray-700">
                    {{ $project->description }}
                </p>

                <p class="text-sm text-gray-500">
                    Statut : {{ $project->statut }}
                </p>

                {{-- VOTE --}}
                <form method="POST" action="{{ route('projects.vote', $project) }}">
                    @csrf
                    <button class="bg-blue-500 text-white px-3 py-1 mt-2 rounded">
                        Voter
                    </button>
                </form>

                {{-- COMMENTAIRE --}}
                <form method="POST" action="{{ route('projects.comment', $project) }}" class="mt-3">
                    @csrf

                    <textarea
                        name="content"
                        class="w-full border p-2"
                        placeholder="Votre commentaire..."
                        minlength="10"
                        maxlength="500"
                        required
                    ></textarea>

                    <button class="bg-green-500 text-white px-3 py-1 mt-2 rounded">
                        Commenter
                    </button>
                </form>

                {{-- COMMENTAIRES --}}
                <div class="mt-4">
                    <h3 class="font-bold">Commentaires</h3>

                    @foreach($project->comments()->latest()->get() as $comment)
                        <div class="border-t py-2">

                            <p>{{ $comment->content }}</p>

                            <small class="text-gray-500">
                                {{ $comment->created_at }}
                            </small>

                            @if($comment->user_id === auth()->id())
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-500 text-sm">
                                        Supprimer
                                    </button>
                                </form>
                            @endif

                        </div>
                    @endforeach
                </div>

            </div>
        @endforeach

    </div>

</x-app-layout>