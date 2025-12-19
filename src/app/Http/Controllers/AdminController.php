<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // categoriesテーブルのリレーションを含めて取得し、7件ずつページネーション
        $contacts = Contact::with('category')->paginate(7);
        
        // 検索窓用のカテゴリ一覧も取得
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
    $query = Contact::with('category');

    // キーワード検索（名前・メール）
    if ($request->keyword) {
        $query->where(function($q) use ($request) {
            $q->where('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    // 性別検索
    if ($request->gender) {
        $query->where('gender', $request->gender);
    }

    // カテゴリ検索
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    // 日付検索
    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->paginate(7);
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
    }
}
