<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contato()
    {
        return $this->belongsTo(User::class);
    }
}
