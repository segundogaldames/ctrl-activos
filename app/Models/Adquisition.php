<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adquisition extends Model
{
    use HasFactory;

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
