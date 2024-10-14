<?php

namespace App\Models;

use App\Models\category;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stock', 'price', 'category_id'];
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
    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }
}
