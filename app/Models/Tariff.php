<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'fixed_charge', 'flat_rate', 'telescopic'];

    public function ranges()
    {
        return $this->hasMany(TariffRange::class);
    }
}
