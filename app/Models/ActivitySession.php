<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivitySession extends Model
{
    /** @use HasFactory<\Database\Factories\ActivitySessionFactory> */
    use HasFactory;
    // A session belongs to the user who logged it.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // A session belongs to the activity it uses.
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
