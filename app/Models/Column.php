<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    //
    protected $table = 'columns';
    protected $fillable = ['title', 'project_id'];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
