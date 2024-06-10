<?php

namespace App\Domain\Scrap\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'currency_symbol',
        'per_unit_usd',
    ];
}
