<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLogs extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'action',
    'description',
    'created_at',
  ];

  // Userモデルへのリンク
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
