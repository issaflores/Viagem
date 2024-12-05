<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
 Protected $table = 'usuarios';

 public function viagem()
 {
     return $this->belongsTo(Viagem::class, 'viagens_id');
 }


}
