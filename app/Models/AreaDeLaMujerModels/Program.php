<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'program_type',
        'start_date',
        'end_date',
        'status',
    ];

    public function violences()
    {
        return $this->hasMany(Violence::class);
    }
}
