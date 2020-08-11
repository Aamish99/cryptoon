<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Alert extends Model
{
    use Notifiable;
    protected $dates = ['recent_activity'];
}
