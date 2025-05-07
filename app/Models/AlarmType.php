<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlarmType extends Model
{
    use HasFactory;

    protected $table = 'alarms_types';

    public function alarms(): HasMany
    {
        return $this->hasMany(Alarm::class, 'alarms_types_id');
    }
}
