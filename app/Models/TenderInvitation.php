<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenderInvitation extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','tender_id','user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function tender(){
        return $this->belongsTo(Tender::class,'tender_id');
    }
}
