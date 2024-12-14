<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BannerQuestion extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function bannerQuestionComments(): HasMany {
        return $this->hasMany(BannerQuestionComment::class)->orderBy('created_at', 'DESC');
    }

}
