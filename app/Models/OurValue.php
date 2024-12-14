<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OurValue extends Model
{
    use HasFactory;


    public function behavior(): HasMany {
        return $this->hasMany(Behavior::class);
    }
}
