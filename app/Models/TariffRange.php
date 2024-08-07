<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TariffRange extends Model
{
    use HasFactory;

    protected $fillable = ['tariff_id', 'start_units', 'end_units', 'rate'];

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }
}
