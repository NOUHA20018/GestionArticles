@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-8 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Ajouter un nouvel article</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('updateArticle',$article->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label for="title" class="block font-medium text-sm text-gray-700">title</label>
               <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="text" name="title" id="" value="{{old('title',$article->title)}}">
                @error('title')
                <div class="text-red">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="contenu" class="block font-medium text-sm text-gray-700">Contenu</label>
                <textarea name="contenu" id="contenu" rows="5"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('contenu',$article->contenu) }}</textarea>
                @error('contenu')
                <div class="text-red">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block font-medium text-sm text-gray-700">Date</label>
                <input type="date" name="date" id="date" value="{{ old('date',$article->date) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('date')
                <div class="text-red">{{$message}}</div>
                @enderror
            </div>

            

            <div>
                <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Update</button>
            </div>
        </form>
    </div>
@endsection
