<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class InvitationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'consumer_id',
        'owner_id',
        'code',
        'consumed_at'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function markAsConsumed(User $user) {
        $this->update([
            'consumer_id' => $user->id,
            'consumed_at' => now()
        ]);
    }

    protected function value(): Attribute{
        return Attribute::make(
            get: fn() => $this->code
        );
    }



    public function consumer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'consumer_id');
    }
}
