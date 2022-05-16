<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = ['hospital_name', 'hospital_order', 'district_id', 'thana_id', 'email', 'phone', 'status'];

    public function districts() {
        return $this->belongsTo('App\Models\District', 'district_id');
    }

    public function thanas() {
        return $this->belongsTo('App\Models\Thana', 'thana_id');
    }
}
