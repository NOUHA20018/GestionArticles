@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #fffdfd;
        }

        .table-container {
            width: 90%;
            margin: 30px auto;
            background-color: #fff7fb;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        th {
            background-color: #fbe0ef;
            padding: 12px;
            border: none;
            border-radius: 12px 12px 0 0;
            text-align: left;
            color: #5c1e3c;
            font-size: 1rem;
        }

        td {
            background-color: #fff;
            padding: 12px 15px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        tr:hover td {
            background-color: #fff0f6;
        }

        .btn {
            display: inline-block;
            background-color: #d66c9b;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 15px;
            transition: 0.3s ease;
        }

        .btn:hover {
            background-color: #e07fa8;
        }

        .action-btn {
            background-color: #a9dfbf;
            color: #1e5631;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
        }

        .action-btn:hover {
            background-color: #82c29f;
        }
        .action-btn2 {
            background-color: #e28f7a;
            color: #820505;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
        }

        .action-btn2:hover {
            background-color: #c9523d;
        }

        .alert-success {
            width: 80%;
            margin: 10px auto;
            color: #276749;
            background-color: #f0fff4;
            border: 1px solid #c6f6d5;
            padding: 12px;
            border-radius: 8px;
        }
    </style>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <a class="btn" href="{{ route('addArticle') }}">➕ Ajouter un article</a>

        <table>
            <tr>
                <th>Id</th>
                <th>Date</th>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Créé par</th>
                <th>Action</th>
            </tr>

            @foreach ($articles as $article)
                <tr>
                    <td><a href="{{ route('showArticle', $article->id) }}">{{ $article->id }}</a></td>
                    <td>{{ $article->date }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->contenu }}</td>
                    <td>{{ $article->user->name ?? 'Utilisateur inconnu' }}</td>
                    <td>
                        {{-- <a class="action-btn" href="{{ route('editArticle', $article->id) }}">✏️ Modifier</a> --}}
                        <a class="action-btn2" href="{{ route('showArticle', $article->id) }}">📌Plus Info</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
