<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BannerQuestionComment extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function bannerQuestionLikes(): HasMany {
        return $this->hasMany(BannerQuestionLike::class);
    }

    public function bannerQuestionImages(): HasOne {
        return $this->hasOne(BannerQuestionImage::class)->withDefault([
            'image' => ''
        ]);
    }

}
