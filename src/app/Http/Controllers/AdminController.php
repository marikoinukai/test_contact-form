<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    $contacts = $query->paginate(7)->withQueryString();
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
    }

public function destroy(Request $request)
{
    // フォームから送られた id を元にデータを削除
    Contact::find($request->id)->delete();
    
    // 一覧画面に戻す
    return redirect('/admin')->with('message', 'お問い合わせを削除しました');
}

public function export(Request $request)
    {
        // 1. 検索条件を反映させてデータを取得
        $query = Contact::query()->with('category');

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        // 2. CSVの生成（ストリームレスポンス）
        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            
            // 文字化け防止（Excel用BOMを追加）
            fwrite($handle, "\xEF\xBB\xBF");

            // ヘッダー行
            fputcsv($handle, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容']);

            // データ行
            foreach ($contacts as $contact) {
                $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->category->content,
                    $contact->detail
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="contacts_' . date('YmdHis') . '.csv"');

        return $response;
    }

    // 1. 追加：検索リセット機能 (PG06)
    public function reset()
    {
        // /admin（一覧画面）にリダイレクトすることで検索条件をクリアする
        return redirect('/admin');
    }
}
