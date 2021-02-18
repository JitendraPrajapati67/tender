<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class TenderCategory extends Model
{
    use SoftDeletes;

    public $table = 'tender_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'parent_id',
        'category_code',
        'category_name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function children()
    {
        return $this->hasMany('\App\Models\TenderCategory', 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo('\App\Models\TenderCategory', 'parent_id');
    }
}
