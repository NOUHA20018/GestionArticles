<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commantaire;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->latest()->get();

        // dd($articles);
        return view('article_commantaire.listes', compact('articles'));
    }

    public function showArticle($id)
    {
        $commantaires = Commantaire::all()->where('article_id','=',$id);
        
        $article = Article::find($id);
        return view('article_commantaire.showArticle', compact('commantaires','article'));
    }

    public function storeArticle(Request $request)
{
    $request->validate([
        'title' =>'required|string|max:1000',
        'contenu' => 'required|string|max:1000',
        'date' => 'required|date',
    ]);

    Article::create([
        'title' => $request->input('title'),
        'contenu' => $request->input('contenu'),
        'date' => $request->input('date'),
        'user_id' => auth()->id(), 
    ]);

    return redirect()->route('listes')->with('success', 'Article ajouté avec succès.');
}
public function addArticle()
{
    // $users = User::all(); 
    return view('article_commantaire.addArticle');
}




public function storeCommantaire(Request $req, $id)
{
    
    $validatedData = $req->validate([
        'contenu' => 'required|string|min:3',
    ]);
    $article = Article::find($id);
    $commantaire = new Commantaire();
    $commantaire->date = Carbon::now(); 
    $commantaire->contenu = $req->contenu;
    $commantaire->article_id = $article->id;
    if (auth()->check()) {
        $commantaire->user_id = auth()->id(); 
    }
        $commantaire->save();
        // dd($commantaire);
        // return redirect()->route('listes', ['id' => $article->id]);
        return redirect()->back()->with('success','commantaire bien ajouter ');
        
    }
    
    public function deleteArticle($id){
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('listes')->with('success', 'Article supprimé avec succès.');

    }

    public function editArticle($id){
        $article = Article::find($id);
        return view('article_commantaire.editArticle',compact('article'));
    }
    
    public function updateArticle(Request $req ,$id){
        $article = Article::find($id);
        $req->validate([
            'title' =>'required|string|max:1000',
            'contenu' => 'required|string|max:1000',
            'date' => 'required|date',
        ]);
    
        $article->update([
            'title' => $req->input('title'),
            'contenu' => $req->input('contenu'),
            'date' => $req->input('date'),
            'user_id' => auth()->id(), 
        ]);
        
        return redirect()->route('listes',compact('article'));
    }
}
