<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Contract extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $fillable = [
        'id',
        'code',
        'day',
        'date',
        'image',
        'terms',
        'seller_id',
        'customer_id',
        'cost',
        'discount',
        'total',
        'tax',
        'net_amount',
        'payment_status',
        'payment_method',
        'notes',
        'project_id',
        'created_by',
        'status',
    ];

    protected $casts = [
        'created_by' => 'integer',
        'status' => 'boolean',
        'payment_status' => 'boolean',
        'date' => 'date',
        'cost' => 'double',
        'discount' => 'double',
        'total' => 'double',
        'tax' => 'double',
        'net_amount' => 'double',
    ];

    public function  scopeSelection($query){

        return $query -> select('id',
                                'code',
                                'day',
                                'date',
                                'image',
                                'terms',
                                'seller_id',
                                'customer_id',
                                'cost',
                                'discount',
                                'total',
                                'tax',
                                'net_amount',
                                'payment_status',
                                'payment_method',
                                'notes',
                                'project_id',
                                'created_by',
                                'status'
                            );
    
    }


    protected $dates = ['deleted_at'];


    public function scopeActive($query){

        return $query->where('status',true);

    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }




}
