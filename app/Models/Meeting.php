<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $fillable = [ 'id', 'date', 'time', 'duration', 'created_by', 'status', ];

    protected $casts = [
        'created_by' => 'integer',
        'status' => 'boolean',
    ];

    public function  scopeSelection($query){

        return $query -> select( 'id', 'date', 'time', 'duration', 'created_by', 'status');
    
    }

    protected $dates = ['deleted_at'];


    public function scopeActive($query){

        return $query->where('status',true);
    }

    public function appointments()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function requests()
    {
        return $this->belongsTo(Request::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }


}
