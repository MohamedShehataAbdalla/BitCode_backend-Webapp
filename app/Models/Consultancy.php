<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Consultancy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $fillable = ['id', 'code','start_date', 'end_date', 'details', 'customer_id', 'employee_id',
    'net_amount', 'payment_status', 'payment_method', 'notes', 'created_by', 'status',];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'created_by' => 'integer',
        'status' => 'boolean',
    ];

    public function  scopeSelection($query){

        return $query -> select('id', 'code','start_date', 'end_date', 'details', 'customer_id', 'employee_id',
        'net_amount', 'payment_status', 'payment_method', 'notes', 'created_by', 'status');
    }

    public function scopeActive($query){

        return $query->where('status',true);
    }


    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }

    
    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

}
