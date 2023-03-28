<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotosHuisdier extends Model
{
    use HasFactory;

    protected $table ="fotos_huisdier";

    public function fotos_huisdierHuisdier(){
        return $this->belongsTo('\App\Models\Huisdier',"huisdier_id","huisdier_id");
    }
}