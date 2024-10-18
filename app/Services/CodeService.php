<?php

namespace App\Services;

use App\Models\Code;
use App\Models\InvitationCode;
use App\Models\User;
use Illuminate\Support\Str;

class CodeService
{
    /**
     * Generate a random code.
     */
    public function random(): string
    {
        return strtoupper(
            Str::random(4) . "-" . rand(101, 999) . "-" . Str::random(4)
        );
    }

    /**
     * Generate multiple codes.
     */
    public function generate(int $count): array
    {
        $codes = [];

        for ($i=1; $i <= $count; $i++) {
            $codes[] = new InvitationCode(['code' => $this->random()]);
        }

        return $codes;
    }

    /**
     * Mark given code as consumed.
     */
    public function markAsConsumed(string $code, User $consumedBy): void
    {
        InvitationCode::whereCode($code)->update([
            'consumed_at' => now(),
            'consumer_id' => $consumedBy->id
        ]);
    }
}
