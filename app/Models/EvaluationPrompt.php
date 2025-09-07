<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationPrompt extends Model
{
    protected $table = 'evaluation_prompts';
    protected $fillable = [
        'prompt',
        'active',
    ];
}
