<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed team
 */
class Subscription extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function team()
    {
        return $this->hasOne('App\Models\Team');
    }

    public function billings()
    {
        return $this->hasMany('App\Models\Billing')->orderBy('period', 'desc');
    }

    public function getMonthlyBillingByUser()
    {
        $userCount = count($this->team->users);
        if ($userCount < 10) return 50 * $userCount;
        elseif ($userCount < 100) return 45 * $userCount;
        elseif ($userCount < 1000) return 40 * $userCount;
        else return 35 * $userCount;
    }
}
