<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{
    use HasFactory;

    protected $connection = 'mysql';


    protected $fillable = [ 'id', 
                            'title', 
                            'sub_title', 
                            'about', 
                            'currency', 
                            'currency_symbol', 
                            'country', 
                            'city', 
                            'province', 
                            'address',
                            'phone', 
                            'mobile', 
                            'email',
                            'email2',
                            'latitude', 
                            'longitude', 
                            'work_dayes', 
                            'work_hours', 
                            'logo', 
                            'favicon', 
                            'created_by'
                        ];



    protected function title(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) =>  preg_replace('/[^a-z ]/i', '', filter_var(strtolower($value) , FILTER_SANITIZE_STRING)),
        );
    }

    protected function Mobile(): Attribute
    {
        return new Attribute(
            get: function ($value)  {

                $number = $value;
                $ac = substr($number, 0, 3);
                $prefix = substr($number, 3, 4);
                $suffix = substr($number, 7, 4);

                return $value != null ? "({$ac}) {$prefix}-{$suffix}" : $value;
            },
            set: fn ($value) => str_replace(['-', '(', ')', ' '], '', filter_var($value , FILTER_SANITIZE_NUMBER_INT)),
        );
    }

    protected function Phone(): Attribute
    {
        return new Attribute(
            get: function ($value)  {

                $number = $value;
                $ac = substr($number, 0, 3);
                $prefix = substr($number, 3, 4);
                $suffix = substr($number, 7, 4);

                return $value != null ? "({$ac}) {$prefix}-{$suffix}" : $value;
            },
            set: fn ($value) => str_replace(['-', '(', ')', ' '], '', filter_var($value , FILTER_SANITIZE_NUMBER_INT)),
        );
    }



}
