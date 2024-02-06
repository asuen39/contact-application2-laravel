<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contacts::with('category')->paginate(10);
        $categories = Category::all(); // カテゴリー情報を取得
        return view('index', ['contacts' => $contacts, 'categories' => $categories]);
    }

    public function search(Request $request)
    {
        $query = Contacts::query();

        //検索ワードでの検索
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($query) use ($keyword) {
                $query->where('first_name', 'like', "%$keyword%")
                    ->orWhere('last_name', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%");
            });
        }

        //性別での検索
        if ($request->has('gender')) {
            $gender = $request->input('gender');
            $query->where('gender', $gender);
        }

        // 日付での検索
        if ($request->filled('date')) {
            $date = $request->input('date');
            $query->whereDate('created_at', $date);
        }

        $searchResults = $query->get();
        $categories = Category::all(); // カテゴリー情報を再度取得

        return view('index', ['contacts' => $searchResults, 'categories' => $categories]);
    }
}
