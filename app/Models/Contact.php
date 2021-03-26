<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'phone','birthdate','contacttype_id','description'
    ];

    public function contacttype(){
        return $this->belongsTo(Contacttype::class);
    }

}
