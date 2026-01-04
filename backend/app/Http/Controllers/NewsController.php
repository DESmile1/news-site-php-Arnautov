<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Отримання новин з фільтрацією та пошуком
    public function index(Request $request)
    {
        $query = News::query();

        // Фільтрація за категорією
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Логіка ПОШУКУ (пошук у заголовку або тексті)
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('full_text', 'like', $searchTerm);
            });
        }

        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    // Отримання однієї новини
    public function show($id)
    {
        $item = News::find($id);
        if (!$item) {
            return response()->json(['message' => 'Новину не знайдено'], 404);
        }
        return response()->json($item);
    }

    // Видалення новини (для адміна)
    public function destroy($id)
    {
        $news = News::find($id);
        if (!$news) {
            return response()->json(['message' => 'Запис не знайдено'], 404);
        }

        $news->delete();
        return response()->json(['message' => 'Новину видалено']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'short_text' => 'required',
            'full_text' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // валідація картинки
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Зберігаємо у storage/app/public/news і отримуємо шлях
            $path = $request->file('image')->store('news', 'public');
            $data['image'] = $path;
        }

        $news = News::create($data);
        return response()->json($news, 201);
    }
}