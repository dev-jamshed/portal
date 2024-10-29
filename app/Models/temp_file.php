<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_file extends Model
{
  use HasFactory;

  public function images()
  {
    return $this->hasMany(Attachment::class, 'ticket_id');
  }
  public function attachments()
  {
    return $this->hasMany(Attachment::class, 'temp_id');
  }
}
