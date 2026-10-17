<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    protected $fillable = ['image_path', 'caption'];
    public function getImageUrlAttribute(): string
    {
        return preg_match('~^https?://~i', $this->image_path) ? $this->image_path : asset('storage/'.$this->image_path);
    }
}
