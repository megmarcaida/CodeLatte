<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glossary extends Model
{
    protected $fillable = ['word','definition','status'];
}
