<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $genres = $request->input('genres');
        $q = $request->input('q');

        $books = Book::query();

        if($q) {
            $books = $books->whereHas('author', function ($query) use ($q) {
                $query->select()->where('name' , 'LIKE', '%'.$q.'%');
            })
            ->with('author')
            ->orWhere('description', 'LIKE', '%'.$q.'%')
            ->orWhere('title', 'LIKE', '%'.$q.'%')
            ;
        }

        if($genres) {
            foreach($genres as $genre) {
                $books = $books->orWhereHas('genres', function ($query) use ($genre) {
                    $query->select()->where('genres.id' , '=', $genre);
                })
                ;
            }
        }

        $books = $books->orderBy('books.created_at','DESC')->paginate(10);
        return view('main', [
            'books' => $books,
            'genres' => Genre::all()
        ]);
    }
}
