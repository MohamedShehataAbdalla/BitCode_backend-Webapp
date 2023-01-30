<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Plan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $fillable = ['id', 'name', 'default','price_day','discount_day', 'price_month', 'discount_month', 'price_year', 'discount_year',   'created_by', 'status',];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'created_by' => 'integer',
        'status' => 'boolean',
    ];

    public function  scopeSelection($query){

        return $query -> select('id', 'name', 'default','price_day','discount_day', 'price_month', 'discount_month', 'price_year', 'discount_year',   'created_by', 'status');
    }

    public function scopeActive($query){

        return $query->where('status',true);
    }

    public function planDetails()
    {
        return $this->hasMany(PlanDetail::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    




}
