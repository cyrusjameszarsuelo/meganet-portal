<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StarAppreciation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'to_name',
        'to_email',
        'thanks_for',
        'situation_task',
        'action_results',
        'selected_values',
        'situation',
        'task',
        'action',
        'results',
        'hype_note',
        'from_name',
        'from_email',
    ];

    protected $casts = [
        'selected_values' => 'array',
    ];
}
