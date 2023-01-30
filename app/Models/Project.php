<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;


class Project extends Model
{
    use SoftDeletes;
    use SearchableTrait;

    protected $connection = 'mysql';

    // protected $guarded = [];

    protected $fillable = ['id', 'name', 'client', 'url', 'price', 'category_id', 'service_id', 'rating', 
    'version','start_date', 'end_date', 'publish_date', 'publish_status', 'created_by', 'status',];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'created_by' => 'integer',
        'status' => 'boolean',
        'price' => "decimal:2",
    ];

    protected function Price(): Attribute
    {
        return new Attribute(
            get: fn ($value) => number_format($value, 2,'.', ''),
            set: fn ($value) => (float)$value,
        );
    }


    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.barcode' => 10,
            'products.description' => 10,
            'products.price' => 10,
            'sections.name' => 10,
            'units.name' => 10,
            'trademarks.name' => 10,
        ],
        'joins' => [
            'sections' => ['products.section_id','sections.id'],
            'units' => ['products.unit_id','units.id'],
            'trademarks' => ['products.trademark_id','trademarks.id'],
        ],
    ];

    public function  scopeSelection($query){

        return $query -> select('id', 'name', 'client', 'url', 'price', 'category_id', 'service_id', 'rating', 
        'version','start_date', 'end_date', 'publish_date', 'publish_status', 'created_by', 'status');
    }

    public function scopeActive($query){

        return $query->where('status',true);
    }

    public function capabilities()
    {
        return $this->belongsToMany(Capability::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function stages()
    {
        return $this->belongsToMany(Stage::class);
    }

    public function developmentTools()
    {
        return $this->hasMany(DevelopmentTool::class);
    }

    public function projectDetail()
    {
        return $this->hasOne(ProjectDetail::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function projectPhotos()
    {
        return $this->hasMany(ProjectPhoto::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }



}
