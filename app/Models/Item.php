<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'stock', 
        'price'
    ];
    protected static function boot()
    {
        parent::boot();

        static::created(function ($item) {
            Log::channel('item-log')->info('ditambahkan', ['id' => $item->id, 'nama' => $item->name,'tanggal' => now()->format('d-m-Y H:i')]);
        });

        static::updated(function ($item) {
            Log::channel('item-log')->info('diedit', ['id' => $item->id, 'nama' => $item->name,'tanggal' => now()->format('d-m-Y H:i')]);
        });

        static::deleted(function ($item) {
            Log::channel('item-log')->info('dihapus', ['id' => $item->id, 'nama' => $item->name,'tanggal' => now()->format('d-m-Y H:i')]);
        });
    }
}
