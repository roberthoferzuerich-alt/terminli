<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_path',
        'caption',
        'views_count',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        return asset('storage/'.$this->image_path);
    }

    public function getFormattedTimeAttribute(): string
    {
        $diffInMinutes = (int) $this->created_at->diffInMinutes(now());

        if ($diffInMinutes < 1) {
            return 'Jetzt';
        }

        if ($diffInMinutes < 60) {
            return $diffInMinutes.' Min.';
        }

        $diffInHours = (int) $this->created_at->diffInHours(now());
        if ($diffInHours < 24) {
            return $diffInHours.' Std.';
        }

        return (int) $this->created_at->diffInDays(now()).' Tg.';
    }
}
