<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'setting_id';

    protected $fillable = [
        'setting_userid',
        'setting_countryid',
        'setting_categoryid',
        'setting_active'
    ];
}
