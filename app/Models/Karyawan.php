<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans';
    protected $fillable = [
        'name', 'bonus'
    ];

    public function scopeSearch($query, $val)
    {
        return $query
        ->where('bonus', 'like', '%'.$val.'%')
        ->Orwhere('name', 'like', '%'.$val.'%');
    }
}
