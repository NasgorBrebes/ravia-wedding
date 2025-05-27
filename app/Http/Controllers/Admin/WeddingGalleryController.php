<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class WeddingGalleryController extends Controller
{
    public function index()
    {
        $galleries = WeddingGallery::orderBy('order')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();

            // Store original image
            $path = $image->storeAs('galleries', $filename, 'public');

            // Create thumbnail (optional)
            $thumbnail = Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $thumbnailPath = 'galleries/thumbnails/' . $filename;
            Storage::disk('public')->put($thumbnailPath, $thumbnail->encode());

            $validatedData['image_url'] = $path;
            $validatedData['thumbnail_url'] = $thumbnailPath;
        }

        $validatedData['is_active'] = $request->has('is_active');

        WeddingGallery::create($validatedData);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri!');
    }

    public function show(WeddingGallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(WeddingGallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, WeddingGallery $gallery)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old images
            if ($gallery->image_url) {
                Storage::disk('public')->delete($gallery->image_url);
            }
            if ($gallery->thumbnail_url) {
                Storage::disk('public')->delete($gallery->thumbnail_url);
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();

            // Store original image
            $path = $image->storeAs('galleries', $filename, 'public');

            // Create thumbnail
            $thumbnail = Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $thumbnailPath = 'galleries/thumbnails/' . $filename;
            Storage::disk('public')->put($thumbnailPath, $thumbnail->encode());

            $validatedData['image_url'] = $path;
            $validatedData['thumbnail_url'] = $thumbnailPath;
        }

        $validatedData['is_active'] = $request->has('is_active');

        $gallery->update($validatedData);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(WeddingGallery $gallery)
    {
        if ($gallery->image_url) {
            Storage::disk('public')->delete($gallery->image_url);
        }
        if ($gallery->thumbnail_url) {
            Storage::disk('public')->delete($gallery->thumbnail_url);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto berhasil dihapus dari galeri!');
    }

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $uploaded = 0;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $uploaded . '_' . $image->getClientOriginalName();

                // Store original image
                $path = $image->storeAs('galleries', $filename, 'public');

                // Create thumbnail
                $thumbnail = Image::make($image)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $thumbnailPath = 'galleries/thumbnails/' . $filename;
                Storage::disk('public')->put($thumbnailPath, $thumbnail->encode());

                WeddingGallery::create([
                    'image_url' => $path,
                    'thumbnail_url' => $thumbnailPath,
                    'alt_text' => 'Gallery Image ' . ($uploaded + 1),
                    'order' => WeddingGallery::max('order') + 1,
                    'is_active' => true
                ]);

                $uploaded++;
            }
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', "Berhasil mengupload {$uploaded} foto!");
    }
}
