<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PlanDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $fillable = ['id', 'name', 'plan_id', 'created_by', 'status',];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'created_by' => 'integer',
        'status' => 'boolean',
    ];

    public function  scopeSelection($query){

        return $query -> select('id', 'name', 'plan_id', 'created_by', 'status');
    }

    public function scopeActive($query){

        return $query->where('status',true);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }



}
