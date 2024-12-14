<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MegaprojectSegment extends Model
{
    use HasFactory;

    use SoftDeletes;

    // public function megaprojects(): HasOne {
    //     return $this->hasOne(Megaproject::class);
    // }

    public function megaproject(): BelongsTo {
        return $this->belongsTo(Megaproject::class);
    }

    public function megaprojectSegmentImages(): HasMany {
        return $this->hasMany(MegaprojectSegmentImage::class);
    }
}
