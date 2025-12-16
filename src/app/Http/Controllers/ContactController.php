<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Admin;
use App\Http\Requests\ContactRequest;
// use App\Models\Admin;

class ContactController extends Controller
{
    public function index()
    {
        // $contacts = Contact::with('admin')->get();
        // $admins = Admin::all();
        // return view('create', compact('contacts', 'admins'));
        $admins = []; 
        $contacts = []; 

        return view('create', compact('contacts','admins'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['admin_id', 'contact_name','price']);
        Contact::create($contact);
        return redirect('/')->with('message', '商品を登録しました');
    }

    public function update(ContactRequest $request)
    {
        $contact = $request->only(['contact_name']);
        Contact::find($request->id)->update($contact);
        return redirect('/')->with('message', '商品を修正しました');
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/')->with('message', 'Contactを削除しました');
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('admin')->AdminSearch($request->admin_id)->KeywordSearch($request->keyword)
        ->PriceSearch($request->price)
        ->get();
        $admins = Admin::all();
        return view('index', compact('contacts', 'admins'));
    }
}
