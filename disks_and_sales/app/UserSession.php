<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $table = 'user_sessions';
    protected $primaryKey = 'id_session';

    protected $fillable = [
        'user_id',
        'expired_date',
        'token'
    ];
}
