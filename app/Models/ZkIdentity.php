<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $provider
 * @property string $provider_id
 * @property string $salt
 * @property string $private_key
 * @property string $max_epoch
 * @property string $randomness
 * @property string $audience
 * @property ?array $zero_knowledge_proof
 * @property ?Carbon $zero_knowledge_proof_expired
 */
class ZkIdentity extends Model
{
    protected $fillable = [
        'provider',
        'provider_id',
        'salt',
        'private_key',
        'max_epoch',
        'randomness',
        'audience',
        'zero_knowledge_proof',
        'zero_knowledge_proof_expired',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'zero_knowledge_proof' => 'json',
    ];
}
