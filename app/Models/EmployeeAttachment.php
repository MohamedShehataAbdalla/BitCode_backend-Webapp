<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmployeeAttachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql';
    
    protected $fillable = ['name', 'attachment',  'employee_id','created_by', 'status',];

    public function  scopeSelection($query){

        return $query -> select('id', 'name', 'attachment',  'employee_id','created_by', 'status');
    }

    public function scopeActive($query){

        return $query->where('status',true);
    }

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
