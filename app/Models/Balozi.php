<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balozi extends Model
{
    protected $table = 'balozi';

    protected $fillable = [
        'mwenyekiti_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'national_id',
        'street_village',
        'shina',
        'shina_number',
        'photo',
        'is_active',
        'last_synced_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'date_of_birth' => 'date',
        'last_synced_at' => 'datetime',
    ];

    public function mwenyekiti()
    {
        return $this->belongsTo(Mwenyekiti::class, 'mwenyekiti_id');
    }

    public function auth()
    {
        return $this->hasOne(BaloziAuth::class, 'balozi_id');
    }

    public function watu()
    {
        return $this->hasMany(Watu::class, 'balozi_id');
    }

    public function kayaMaskini()
    {
        return $this->hasMany(KayaMaskini::class, 'created_by');
    }

    public function maendeleoYaSiku()
    {
        return $this->hasMany(MaendeleoYaSiku::class, 'created_by');
    }

    public function mahitajiMaalumu()
    {
        return $this->hasMany(MahitajiMaalumu::class, 'created_by');
    }
}