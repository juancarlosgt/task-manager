<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function column()
    {
        return $this->belongsTo(Column::class);
    }
}
