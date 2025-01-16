<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LigaTaldea extends Pivot
{
    protected $table="liga_taldea";

    protected $filable =[
        'taldea_id',
        'liga_id',
        'erabilgarritasuna',
        'erositako_prezioa',
        'saldutako_prezioa',
    ];

    

}
