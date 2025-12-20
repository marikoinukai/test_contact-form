<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;


        // ここにリレーションを定義します
    public function category()
    {
        // contactsテーブルのcategory_idは、categoriesテーブルのidに紐付いています
        return $this->belongsTo(Category::class);
    }
        
        protected $fillable = [
           'category_id',
           'first_name',
           'last_name',
           'gender',
           'email',
           'tel',
           'address',
           'building',        
           'detail'
        ];
}
