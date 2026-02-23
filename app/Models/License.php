<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;


     protected $fillable = [
        'trial_started_at',
        'trial_revoked_at',
        'trial_restored_at',
        'machine_id',
    ];

    protected $casts = [
        'trial_started_at' => 'datetime',
        'trial_revoked_at' => 'datetime',
        'trial_restored_at' => 'datetime',
    ];

    public function isTrialDisabled(): bool
    {
        return $this->trial_revoked_at && ! $this->trial_restored_at;
    }
}
