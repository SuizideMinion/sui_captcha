<?php

namespace Suizide\Captcha\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Captcha extends Model
{
    use HasFactory;

    protected $fillable = [
      'answer',
      'question',
      'ip',
      'message'
    ];

}
