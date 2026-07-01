<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryOrder = ['kerupuk', 'frozen_food', 'additional_topping', 'sayur'];
        
        // ✅ PERBAIKAN: Ambil SEMUA menu (termasuk yang tidak tersedia)
        // agar bisa ditampilkan dengan watermark "Tidak Tersedia"
        $menus = Menu::orderBy('category')
            ->orderBy('name')
            ->get()
            ->groupBy('category');

        $sortedMenus = collect($categoryOrder)
            ->filter(fn($cat) => $menus->has($cat))
            ->mapWithKeys(fn($cat) => [$cat => $menus[$cat]])
            ->merge($menus->filter(fn($items, $cat) => !in_array($cat, $categoryOrder)));

        return view('dashboard', ['menus' => $sortedMenus]);
    }

    public function tambah()
    {
        return view('tambah_menu');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'ketersediaan' => 'required|in:tersedia,tidak_tersedia',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'image.mimes' => 'Format image harus JPG, JPEG, atau PNG',
            'image.max' => 'Ukuran image maksimal 2MB',
            'category.required' => 'Jenis menu harus dipilih',
            'name.required' => 'Nama menu harus diisi',
            'price.required' => 'Harga harus diisi',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        // Pastikan price dalam format integer
        $price = preg_replace('/[^0-9]/', '', $validated['price']);

        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (int) $price,
            'category' => $request->category,
            'image' => $imagePath,
            'is_available' => $request->ketersediaan === 'tersedia' ? 1 : 0, // ✅ Konsisten
        ]);

        return redirect()->route('dashboard')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'ketersediaan' => 'required|in:tersedia,tidak_tersedia',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'image.mimes' => 'Format image harus JPG, JPEG, atau PNG',
            'image.max' => 'Ukuran image maksimal 2MB',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $imagePath = $request->file('image')->store('menus', 'public');
        } else {
            $imagePath = $menu->image;
        }

        $price = preg_replace('/[^0-9]/', '', $validated['price']);

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (int) $price,
            'category' => $request->category,
            'image' => $imagePath,
            'is_available' => $request->ketersediaan === 'tersedia' ? 1 : 0, // ✅ Konsisten
        ]);

        return redirect()->route('dashboard')->with('success', 'Menu berhasil diupdate!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }
        $menu->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus!');
    }
}