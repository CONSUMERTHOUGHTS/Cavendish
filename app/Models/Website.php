<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'url'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
