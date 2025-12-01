<?php

namespace App\Models;

use App\Http\Controllers\BorrowController;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
      protected $fillable = ['title','author','category','isbn','quantity'];
        // Define relationship
    public function borrowings()
    {
        return $this->hasMany(BorrowController::class);
    }
}
