<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images','public');
        }

        Article::create([
            'title' => $request->title,
            'content'=>$request->content,
            'featured_image' =>$image_name
        ]);
        return 'Artikel berhasil disimpan';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article = Article::find($id);
        return view('articles.edit',['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $article = Article::find($id);

        $article->title = $request->title;
        $article->content = $request->content;

        if ($article->featured_image && file_exists(storage_path('app/public/'.$article->featured_image))) {
            \Storage::delete('public/'.$article->featured_image);
        }
        $image_name = $request->file('image')->store('images','public');
        $article->featured_image = $image_name;

        $article->save();
        return 'Artikel berhasil dibuah';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function cetak_pdf () {
        $articles = Article::all();
        $pdf = PDF::loadview('articles.articles_pdf' ,['articles'=>$articles]);
        // membuat file PDF dengan menggunakan view articles_pdf.blade.php dan data yang diberikan dalam variabel $articles.

        return $pdf->stream();
        // mengembalikan file PDF dalam bentuk stream ke browser pengguna, sehingga pengguna dapat melihat dan menyimpan file PDF tersebut di komputernya.
        // "Mengembalikan file PDF dalam bentuk stream" berarti menghasilkan file PDF langsung ke browser sebagai output stream tanpa menyimpannya di server atau sistem file
    }
}