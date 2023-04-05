<?php

namespace App\Models;

use App\Enums\TunnelAutoRenew;
use App\Enums\TunnelStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tunnel extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => TunnelStatus::class,
        'auto_renew' => TunnelAutoRenew::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'username';
    }

    protected $fillable = [
        'user_id', 'server_id', 'status', 'username', 'auto_renew', 'password', 'ip_server', 'server', 'local_addrss', 'ip_tunnel', 'domain', 'web', 'api', 'winbox', 'expired', 'to_ports_api',
        'to_ports_winbox',
        'to_ports_web',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
