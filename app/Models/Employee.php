<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Model
{
    protected $connection = 'mysql';

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'first_name', 'middle_name', 'last_name', 'address', 'qualification', 
    'job', 'job_description', 'personal_id',  'gender', 'image', 'mobile', 'dirth_date',  
    'salary', 'commission_percentage', 'join_date', 'rating', 'created_by' , 'user_id', 'status',];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'personalID' => 'integer',
        'mobile' => 'string',
        'dirthDate' => 'date',
        'joinDate' => 'date',
        'created_by' => 'integer',
        'rating' => 'integer',
        'status' => 'boolean',
    ];

    public function  scopeSelection($query){

        return $query -> select('id', 'first_name', 'middle_name', 'last_name', 'address', 'qualification', 
        'job', 'job_description', 'personal_id',  'gender', 'image', 'mobile', 'dirth_date',  'salary', 
        'commission_percentage', 'join_date', 'rating', 'created_by' , 'user_id', 'status');
    }


    public function scopeActive($query){

        return $query->where('status',true);

    }

    public function scopeGenderMale($query){

        return $query->where('gender','m');

    }

    public function scopeGenderFemale($query){

        return $query->where('gender','f');

    }

    protected function Gender(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value == 'm' ? 'Male' : 'Female',
        );
    }

    // protected function first_name(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => ucfirst($value),
    //         set: fn ($value) =>  preg_replace('/[^a-z ]/i', '', filter_var(strtolower($value) , FILTER_SANITIZE_STRING)),
    //     );
    // }

    // protected function middle_name(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => ucfirst($value),
    //         set: fn ($value) =>  preg_replace('/[^a-z ]/i', '', filter_var(strtolower($value) , FILTER_SANITIZE_STRING)),
    //     );
    // }


    // protected function last_name(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => ucfirst($value),
    //         set: fn ($value) =>  preg_replace('/[^a-z ]/i', '', filter_var(strtolower($value) , FILTER_SANITIZE_STRING)),
    //     );
    // }


    protected function job(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }

    protected function birth_date(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value->format('d-m-Y'),
            set: fn ($value) => $value->format('d-m-Y'),
        );
    }

    // protected function join_date(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => $value->format('d-m-Y'),
    //         set: fn ($value) => $value->format('d-m-Y'),
    //     );
    // }


    protected function Salary(): Attribute
    {
        return new Attribute(
            get: fn ($value) => number_format($value, 2, ',', '.'),
            set: fn ($value) => number_format($value, 2, '', '.'),
        );
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

    // protected function personal_id(): Attribute
    // {
    //     return new Attribute(
    //         get: function ($value) {

    //             $p1 = substr($value, 0, 1);
    //             $p2 = substr($value, 1, 2);
    //             $p3 = substr($value, 3, 2);
    //             $p4 = substr($value, 5, 2);
    //             $p5 = substr($value, 7, 2);
    //             $p6 = substr($value, 9, 3);
    //             $p7 = substr($value, 12, 2);

    //             return $value != null ? "{$p1} {$p2} {$p3} {$p4} {$p5} {$p6} {$p7}" : $value;
    //         },
    //         set: fn ($value) => str_replace(' ', '', filter_var($value , FILTER_SANITIZE_NUMBER_INT)),
    //     );
    // }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    
    public function consultancies()
    {
        return $this->hasMany(Consultancy::class);
    }

    public function contractes()
    {
        return $this->hasMany(Contract::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function developmentTools()
    {
        return $this->hasMany(DevelopmentTool::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
