<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'participant_id', 'poll_option_id', 'response',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function option()
    {
        return $this->belongsTo(PollOption::class, 'poll_option_id');
    }
}
