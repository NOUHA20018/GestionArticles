@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #fefefe;
        }

        .btn {
            background-color: #8e3e63;
            color: white;
            margin: 5px 0;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #a74d79;
        }

        .article-container {
            max-width: 720px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff7f9;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .comment-box {
            background-color: #fce8ef;
            border-left: 4px solid #d66c9b;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 10px;
        }

        .comment-author {
            font-weight: bold;
            color: #6b213e;
        }

        .comment-date {
            font-size: 0.8rem;
            color: #999;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #5c1e3c;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }
    </style>

    <div class="article-container">
        <h1 class="text-2xl font-bold mb-4">{{ $article->title }}</h1>
        <p class="text-sm text-gray-500 mb-2">
            Publié le {{ \Carbon\Carbon::parse($article->date)->format('d/m/Y') }}
        </p>

        <div class="prose max-w-none mb-6 text-left">
            <strong>Contenu</strong>
            <p>{{ $article->contenu }}</p>
        </div>
        @if(auth()->id() == $article->user_id)
        <div class=" flex mt-6 space-x-2">

            <button type="submit" class="btn" style="background-color: #3c9642;"><a href="{{ route('editArticle', $article->id) }}">✏️ Modifier l'article</a></button>

            
            <form action="{{ route('deleteArticle', $article->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background-color: #c0392b;">🗑️ Supprimer l'article</button>
            </form>
            
        </div>
        @endif

        <hr class="my-6">

        <div class="text-left">
            <h2 class="text-lg font-semibold mb-4">💬 Commentaires :</h2>

            @forelse ($commantaires as $commantaire)
                <div class="comment-box">
                    <span class="comment-author">{{ $commantaire->user->name ?? 'Utilisateur inconnu' }}</span>
                    <span class="comment-date">
                        ({{ \Carbon\Carbon::parse($commantaire->date)->format('d/m/Y') }})
                    </span>
                    <p class="mt-1">{{ $commantaire->contenu }}</p>
                </div>
            @empty
                <p class="text-gray-500">Aucun commentaire pour l’instant.</p>
            @endforelse
        </div>

        <div class="mt-8 text-left">
            <form action="{{ route('storeCommantaire', $article->id) }}" method="POST">
                @csrf
                <label for="contenu" class="form-label">Ajouter un commentaire :</label>
                <input type="text" name="contenu" id="contenu" placeholder="Votre commentaire ici..." value="{{ old('contenu') }}">
                @error('contenu')
                    <div class="text-red-600 text-sm mb-2">{{ $message }}</div>
                @enderror
                <button class="btn" type="submit">➕ Ajouter le commentaire</button>
            </form>
        </div>
    </div>
@endsection
