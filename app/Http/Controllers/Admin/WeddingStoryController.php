<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeddingStoryController extends Controller
{
    public function index()
    {
        $stories = WeddingStory::orderBy('order')->get();
        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('admin.stories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'story' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('stories', 'public');
        }

        $validatedData['is_active'] = $request->has('is_active');

        WeddingStory::create($validatedData);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Cerita berhasil ditambahkan!');
    }

    public function show(WeddingStory $story)
    {
        return view('admin.stories.show', compact('story'));
    }

    public function edit(WeddingStory $story)
    {
        return view('admin.stories.edit', compact('story'));
    }

    public function update(Request $request, WeddingStory $story)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'story' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($story->image) {
                Storage::disk('public')->delete($story->image);
            }
            $validatedData['image'] = $request->file('image')->store('stories', 'public');
        }

        $validatedData['is_active'] = $request->has('is_active');

        $story->update($validatedData);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Cerita berhasil diperbarui!');
    }

    public function destroy(WeddingStory $story)
    {
        if ($story->image) {
            Storage::disk('public')->delete($story->image);
        }

        $story->delete();

        return redirect()->route('admin.stories.index')
            ->with('success', 'Cerita berhasil dihapus!');
    }
}
