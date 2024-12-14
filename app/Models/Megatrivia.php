<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Megatrivia extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function megatriviaAnswers(): HasMany {
        return $this->hasMany(MegatriviaAnswer::class)->groupBy('user')->orderBy('created_at', 'ASC');
    }
}
