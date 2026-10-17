<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'price', 'category', 'image_path', 'is_featured', 'is_available', 'is_sample'];
    protected $casts = ['is_featured' => 'boolean', 'is_available' => 'boolean', 'is_sample' => 'boolean'];

    public function getRouteKeyName(): string { return 'slug'; }
    public function orders() { return $this->hasMany(Order::class); }
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) return null;
        return preg_match('~^https?://~i', $this->image_path) ? $this->image_path : asset('storage/'.$this->image_path);
    }
    public function getPriceLabelAttribute(): string { return 'Rp '.number_format($this->price, 0, ',', '.'); }
}
