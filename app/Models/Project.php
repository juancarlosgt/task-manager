<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['name', 'description','user_id'];

    

    // Relación con Column
    public function columns()
    {
        return $this->hasMany(Column::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
