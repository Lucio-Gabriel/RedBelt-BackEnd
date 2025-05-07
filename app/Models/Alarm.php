<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alarm extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function alarmType(): BelongsTo
    {
        return $this->belongsTo(AlarmType::class, 'alarms_types_id');
    }
}
