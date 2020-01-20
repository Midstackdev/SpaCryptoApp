<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
    	'user_id',
    	'balance',
    	'wallet_id',
    	'label',
    	'passphrase',
    	'coin'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'wallet_id';
    }
}
