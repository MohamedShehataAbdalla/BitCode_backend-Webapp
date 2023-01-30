<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $fillable = ['id', 'question', 'answer', 'created_by', 'status',];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'created_by' => 'integer',
        'status' => 'boolean',
    ];

    public function  scopeSelection($query){

        return $query->select('id', 'question', 'answer', 'created_by', 'status');
    }

    public function scopeActive($query){

        return $query->where('status',true);
    }


}
