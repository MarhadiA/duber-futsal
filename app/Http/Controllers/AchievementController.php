<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest()->get();
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi tiap foto
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('achievements', 'public');
            }
        }

        Achievement::create([
            'title' => $request->title,
            'description' => $request->description,
            'photos' => $photoPaths, // Disimpan sebagai array/JSON
        ]);

        return redirect()->route('achievements.index')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $photoPaths = $achievement->photos ?? [];

        // Jika ada upload foto baru, tambahkan ke array atau ganti
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('achievements', 'public');
            }
        }

        $achievement->update([
            'title' => $request->title,
            'description' => $request->description,
            'photos' => $photoPaths,
        ]);

        return redirect()->route('achievements.index')->with('success', 'Prestasi berhasil diupdate!');
    }

    public function destroy(Achievement $achievement)
    {
        // Hapus semua file foto dari storage
        if ($achievement->photos) {
            foreach ($achievement->photos as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }

        $achievement->delete();

        return redirect()->route('achievements.index')->with('success', 'Prestasi berhasil dihapus!');
    }
}
