<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivitySession extends Model
{
    /** @use HasFactory<\Database\Factories\ActivitySessionFactory> */
    use HasFactory;

    // Fields that create() may fill from a form. user_id is deliberately missing:
    // it comes from the logged-in user through the relationship, never from the form.
    protected $fillable = ['activity_id', 'date', 'duration', 'notes'];
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
