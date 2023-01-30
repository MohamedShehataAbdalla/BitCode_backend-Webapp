<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;


class ProjectDetail extends Model
{
    use SoftDeletes;
    use SearchableTrait;

    protected $connection = 'mysql';

    // protected $guarded = [];

    protected $fillable = ['id', 'project_id', 'brief', 'objectives', 'benefits', 'description', 'requirements', 'other', 'created_by', 'status',];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'created_by' => 'integer',
        'status' => 'boolean',
    ];

    public function  scopeSelection($query){

        return $query -> select('id', 'project_id', 'brief', 'objectives', 'benefits', 'description', 'requirements', 'other', 'created_by', 'status');
    }

    public function scopeActive($query){

        return $query->where('status',true);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }




}
