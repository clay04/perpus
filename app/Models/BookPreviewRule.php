<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookPreviewRule extends Model
{
    protected $table = 'tbl_book_preview_rules';

    protected $fillable = [
        'book_id',
        'preview_pages',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
