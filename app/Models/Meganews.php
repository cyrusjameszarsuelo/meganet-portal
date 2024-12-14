<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meganews extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    public function meganews_images(): HasMany {
        return $this->hasMany(MeganewsImage::class);
    }

    public function meganewsComments(): HasMany {
        return $this->hasMany(MeganewsComment::class)->orderBy('created_at', 'DESC');
    }

    public function meganewsLikes(): HasMany {
        return $this->hasMany(MeganewsLike::class);
    }
}
