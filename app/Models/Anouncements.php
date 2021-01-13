<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Anouncements extends Model
{
    use SoftDeletes;
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'announcement';
}
