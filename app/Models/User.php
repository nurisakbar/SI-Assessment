<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'tanggal_lahir',
        'pekerjaan',
        'tokens',
        'free_trial_remaining',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'free_trial_remaining' => 'integer',
    ];

    public function jawaban(){
        return $this->belongsTo(Jawaban::class, 'id', 'user_id');
    }

    public function tokenTransactions()
    {
        return $this->hasMany(TokenTransaction::class);
    }

    public function hasFreeTrialAvailable(): bool
    {
        if (! config('app.free_trial_enabled', true)) {
            return false;
        }

        if ($this->level !== 'guest') {
            return false;
        }

        return ($this->free_trial_remaining ?? 0) > 0;
    }

    public function freeTrialRemaining(): int
    {
        if (! config('app.free_trial_enabled', true) || $this->level !== 'guest') {
            return 0;
        }

        return max(0, (int) ($this->free_trial_remaining ?? 0));
    }

    public function canAccessAssessment(): bool
    {
        return $this->tokens > 0 || $this->hasFreeTrialAvailable();
    }
}
