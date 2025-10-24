<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['name', 'description'];

    

    // Relación con Column
    public function columns()
    {
        return $this->hasMany(Column::class);
    }

}
