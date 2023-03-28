<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tunnel extends Model
{
    use HasFactory;
    public function getRouteKeyName(): string
    {
        return 'username';
    }

    protected $fillable = [
        'user_id', 'server_id','username','auto_renew', 'password', 'ip_server', 'server', 'local_addrss', 'ip_tunnel', 'domain', 'web', 'api', 'winbox', 'expired', 'to_ports_api',
        'to_ports_winbox',
        'to_ports_web',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
