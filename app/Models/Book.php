<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'tbl_books';

    protected $fillable = [
        'judul',
        'isbn',
        'penulis',
        'kategori',
        'stok',
        'status',
    ];

    public function peminjaman()
    {
        return $this->hasManu(Peminjaman::class);
    }

    public function file()
    {
        return $this->hasOne(BookFile::class, 'book_id');
    }

    public function previewRule()
    {
        return $this->hasOne(BookPreviewRule::class, 'book_id');
    }

}
