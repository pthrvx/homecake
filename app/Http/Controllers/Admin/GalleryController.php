<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index() { return view('admin.gallery.index', ['photos' => GalleryPhoto::latest()->get()]); }

    public function store(Request $r)
    {
        $d = $r->validate(
            ['image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'], 'caption' => ['required', 'string', 'max:150']],
            ['required' => ':attribute wajib diisi.', 'image.image' => 'File harus berupa gambar.', 'image.mimes' => 'Foto harus jpg, png, atau webp.', 'image.max' => 'Ukuran foto maksimal 2 MB.'],
            ['image' => 'Foto', 'caption' => 'Keterangan foto']
        );
        GalleryPhoto::create(['caption' => $d['caption'], 'image_path' => $r->file('image')->store('gallery', 'public')]);
        return back()->with('ok', 'Foto ditambahkan.');
    }

    public function destroy(GalleryPhoto $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return back()->with('ok', 'Foto dihapus.');
    }
}
