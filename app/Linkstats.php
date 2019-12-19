<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Linkstats extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'link_stats';

    protected $fillable = [
        'links_id', 'ip_address', 'browser', 'language', 'referer',
    ];

}
