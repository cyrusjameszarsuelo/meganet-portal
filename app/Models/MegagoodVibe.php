<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MegagoodVibe extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function megagoodVibeComments(): HasMany {
        return $this->hasMany(MegagoodVibesComment::class)->orderBy('created_at', 'DESC');
    }

    public function megagoodVibeLikes(): HasMany {
        return $this->hasMany(MegagoodVibesLike::class);
    }
}
