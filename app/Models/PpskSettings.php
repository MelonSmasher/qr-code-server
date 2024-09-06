<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;

class PpskSettings extends Model {
    use HasFactory;

    protected $fillable = [
        'ppsk_id',
        'qr_code_path',
        'ssid',
        'created_for',
        'identity',
        'hidden',
        'passphrase',
        'security',
        'eap_method',
        'phase_two_auth',
        'anonymous_outer_identity',
    ];

    public function ppsk(): BelongsTo {
        return $this->belongsTo(Ppsk::class);
    }

    public static function boot() {
        parent::boot();

        PpskSettings::deleted(function ($settings) {
            if (key_exists('qr_code_path', $settings)) {
                if (!empty($settings->qr_code_path)) {
                    $file = public_path() . '/' . $settings->qr_code_path;
                    if (File::isFile($file)) {
                        File::delete($file);
                    }
                }
            }
        });
    }
}
