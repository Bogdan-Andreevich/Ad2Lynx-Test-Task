<?php

namespace App\Services;

use App\Models\Ad;

class AdService
{
    public function bulkCreate(array $arr) {
        return Ad::insert($arr);
    }
}
