<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Lab extends Model
{
    use HasFactory;
    // use SoftDeletes;
    use LogsActivity;

    protected static $logAtttributes = ['*'];
    protected static $logName = 'lab';

}
