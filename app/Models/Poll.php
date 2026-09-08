<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'user_id', 'uuid', 'title', 'description', 'location', 'meeting_url',
        'timezone', 'status', 'allow_maybe', 'closes_at', 'finalized_option_id',
    ];

    protected $casts = [
        'allow_maybe' => 'boolean',
        'closes_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
