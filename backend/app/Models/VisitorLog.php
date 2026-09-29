<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VisitorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_hash',
        'url',
        'device',
        'referer',
        'user_agent',
        'visit_date',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    /**
     * Catat kunjungan pengunjung baru atau pageview
     */
    public static function recordVisit(Request $request, ?string $path = '/'): self
    {
        $ip = $request->ip() ?? '127.0.0.1';
        $ipHash = hash('sha256', $ip . config('app.key'));
        $userAgent = $request->userAgent() ?? '';
        $referer = $request->header('referer');

        // Deteksi jenis perangkat sederhana
        $device = 'Desktop';
        if (preg_match('/(android|iphone|ipad|mobile|tablet)/i', $userAgent)) {
            $device = 'Mobile';
        }

        $cleanPath = '/' . ltrim(parse_url($path ?: '/', PHP_URL_PATH) ?: '', '/');

        return static::create([
            'ip_hash' => $ipHash,
            'url' => substr($cleanPath, 0, 255),
            'device' => $device,
            'referer' => $referer ? substr($referer, 0, 500) : null,
            'user_agent' => $userAgent,
            'visit_date' => now()->toDateString(),
        ]);
    }
}
