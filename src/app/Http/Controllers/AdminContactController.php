<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\AdminRequest;

class AdminContactController extends Controller
{
    public function index()
    {
        // $admins = Admin::all();
        
        // return view('admin', compact('admins'));
        
        $admins = []; 

        return view('index', compact('admins'));
    }

     public function store(AdminRequest $request)
    {
        $admin = $request->only(['name']);
        Admin::create($admin);

        return redirect('/admins')->with('message', 'カテゴリを作成しました');
    }

     public function update(AdminRequest $request)
    {
        $admin = $request->only(['name']);
        Admin::find($request->id)->update($admin);

        return redirect('/admins')->with('message', 'カテゴリを更新しました');
    }  

    public function destroy(Request $request)
    {
        Admin::find($request->id)->delete();

        return redirect('/admins')->with('message', 'カテゴリを削除しました');
    }
}
