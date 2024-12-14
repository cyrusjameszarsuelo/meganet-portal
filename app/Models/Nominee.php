<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nominee extends Model
{
    use HasFactory, SoftDeletes;

    public function NomineeBehavior(): HasMany {
        return $this->hasMany(NomineeBehavior::class);
    }

    public function NomineeValue(): HasMany {
        return $this->hasMany(NomineeValue::class);
    }
}
