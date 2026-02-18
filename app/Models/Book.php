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
        'penerbit',
        'tahun_terbit',
        'kota_terbit',
        'edisi',
        'kategori',
        'stok',
        'status',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function activeLoan()
    {
        return $this->hasOne(Peminjaman::class, 'book_id')
            ->where('status', 'dipinjam');
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
