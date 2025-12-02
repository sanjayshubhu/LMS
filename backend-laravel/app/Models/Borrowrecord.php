<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class Borrowrecord extends Model
{
    protected $fillable = ['user_id', 'book_id', 'borrowed_date', 'returned_date', 'status'];
    protected $casts = [
        'borrow_date' => 'datetime',
        'return_date' => 'datetime'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
