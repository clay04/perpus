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
}
