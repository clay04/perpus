<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookFile extends Model
{
    protected $table = 'tbl_book_files';

    protected $fillable = [
        'book_id', 
        'file_name', 
        'file_path', 
        'file_type',
        'file_size',
        'total_pages'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
