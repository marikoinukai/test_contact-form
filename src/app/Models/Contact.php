<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  use HasFactory;
        protected $fillable = [
            'admin_id',
            'contact_name',
            'price'];
            
  public function admin()
   {
        return $this->belongsTo(Admin::class);
   }

  public function scopeAdminSearch($query, $admin_id)
  {
    if (!empty($admin_id)) {
      $query->where('admin_id', $admin_id);
    }
  }

  public function scopeKeywordSearch($query, $keyword)
  {
    if (!empty($keyword)) {
      $query->where('contact_name', 'like', '%' . $keyword . '%');
    }
    return $query;
  }

  public function scopePriceSearch($query, $price)
  {
    if (!empty($price)) {
      $query->where('price', $price);
    }
    return $query;
  }
}
