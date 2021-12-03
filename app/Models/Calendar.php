<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = ['start', 'code', 'phone_number', 'service_id', 'title', 'body', 'url'];

    // $calendar->user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // $calendar->service
    public function service(){
		return $this->belongsTo(Service::class);
	}
}
