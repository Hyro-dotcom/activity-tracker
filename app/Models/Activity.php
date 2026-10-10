<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory;

    // Fields that create() may fill from the activity form.
    protected $fillable = ['name', 'description'];
    // An Activity can appear in many sessions, from any user
    public function activitySessions(): HasMany
    {
        return $this->hasMany(ActivitySession::class);
    }
}
