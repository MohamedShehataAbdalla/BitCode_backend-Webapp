<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CustomerAttachment extends Model
{
    protected $connection = 'mysql';
    
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'attachment',  'customer_id','created_by', 'status',];

    public function  scopeSelection($query){

        return $query -> select('id', 'name', 'attachment',  'customer_id','created_by', 'status');
    }

    public function scopeActive($query){

        return $query->where('status',true);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
}
