<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;


class Company extends Model
{
    protected $connection = 'mysql';

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'name', 'field_of_work', 'tax_record', 'commercial_register',  'logo',  'mobile',  
    'rating', 'special', 'address', 'latitude','longitude', 'created_by', 'status',];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'personalID' => 'integer',
        'mobile' => 'string',
        'dirthDate' => 'date',
        'joinDate' => 'date',
        'rating' => 'integer',
        'created_by' => 'integer',
        'status' => 'boolean',
    ];

    public function  scopeSelection($query){

        return $query -> select('id', 'name', 'field_of_work', 'tax_record', 'commercial_register',  'logo',  'mobile',  
    'rating', 'special', 'address', 'latitude','longitude', 'created_by', 'status');
    
    }


    public function scopeActive($query){

        return $query->where('status',true);

    }


    protected function mobile(): Attribute
    {
        return new Attribute(
            get: function ($value)  {

                $phone = $value;
                $ac = substr($phone, 0, 3);
                $prefix = substr($phone, 3, 4);
                $suffix = substr($phone, 7, 4);

                return $value != null ? "({$ac}) {$prefix}-{$suffix}" : $value;
            },
            set: fn ($value) => str_replace(['-', '(', ')', ' '], '', filter_var($value , FILTER_SANITIZE_NUMBER_INT)),
        );
    }


    public function customers()
    {
        return $this->hasMany(Customer::class);
    }


}
