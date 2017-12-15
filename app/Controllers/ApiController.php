<?php
namespace App\Controllers;
use App\Models\Book;
class ApiController
{
    public function getBook($id = null)
    {
        if (is_null($id)) {
            $books = Book::all();
            header('Content-Type: application/json');
            return json_encode($books);
        } else {
            $book = Book::find($id);
            header('Content-Type: application/json');
            return json_encode($book);
        }
    }
}