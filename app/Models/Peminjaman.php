<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;

class Peminjaman extends Model
{
    protected $table = 'tbl_peminjaman';

    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',   
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_dikembalikan' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getIsOverdueAttribute()
    {
        if ($this->status !== 'dipinjam') {
            return false;
        }

        return Carbon::now()->gt($this->tanggal_kembali);
    }

    public function getDurasiPinjamAttribute()
    {
        return $this->tanggal_pinjam->diffInDays($this->tanggal_kembali);
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'dipinjam' => 'Dipinjam',
            'dikembalikan' => 'Dikembalikan',
            'terlambat' => 'Terlambat',
            default => ucfirst($this->status),
        };
    }
}
