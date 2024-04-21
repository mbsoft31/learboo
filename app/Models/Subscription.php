<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['email'];

    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeActive($query)
    {
        return $query->where('unsubscribe_at', null);
    }

    public function scopeUnsubscribed($query)
    {
        return $query->where('unsubscribe_at', '!=', null);
    }

    public function unsubscribe(): bool
    {
        return $this->update(['unsubscribe_at' => now()]);
    }

    public function subscribe(): bool
    {
        return $this->update(['unsubscribe_at' => null]);
    }

    public function isSubscribed(): bool
    {
        return is_null($this->unsubscribe_at);
    }
}
