<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Indicator;

class Indicator extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'source'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'indicator_user');
    }
}
