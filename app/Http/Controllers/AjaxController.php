<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * react to a book ajax call
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function react(Request $request)
    {
        $id = $request->input('id');
        $type = $request->input('type');
        
        $book = Book::find($id);
        if($type == "like")
            $book->likes++;
        else
            $book->likes--;
        $book->save();

        return response()->json([
            'result' => 'success',
            'book' => $book->likes
        ]);
    }
}
