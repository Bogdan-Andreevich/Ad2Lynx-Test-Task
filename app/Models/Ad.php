<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'ad_id',
        'impressions',
        'clicks',
        'unique_clicks',
        'leads',
        'conversion',
        'roi',
    ];
}
