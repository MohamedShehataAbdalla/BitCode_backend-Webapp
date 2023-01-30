<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProjectPhoto extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    
    protected $fillable = ['id', 'project_id', 'photo', 'photo_main', 'created_by', 'status',];

    public function  scopeSelection($query){

        return $query -> select('id', 'project_id', 'photo', 'photo_main', 'created_by', 'status');
    }

    public function scopeActive($query){

        return $query->where('status',true);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


}
