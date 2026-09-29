<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'country',
        'qualification',
        'message',
        'status',
        'ip_address',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    // Boot: capture IP
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($enquiry) {
            $enquiry->ip_address = request()->ip();
        });
    }

    // Status badge helper
    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'new'       => '<span class="badge badge-new">New</span>',
            'read'      => '<span class="badge badge-read">Read</span>',
            'contacted' => '<span class="badge badge-contacted">Contacted</span>',
            'enrolled'  => '<span class="badge badge-enrolled">Enrolled</span>',
            'rejected'  => '<span class="badge badge-rejected">Rejected</span>',
            default     => '<span class="badge">Unknown</span>',
        };
    }

    // Country label helper
    public function getCountryLabelAttribute(): string
    {
        return match($this->country) {
            'germany'     => '🇩🇪 Germany',
            'poland'      => '🇵🇱 Poland',
            'hungary'     => '🇭🇺 Hungary',
            'czech'       => '🇨🇿 Czech Republic',
            'romania'     => '🇷🇴 Romania',
            'latvia'      => '🇱🇻 Latvia',
            'undecided'   => '❓ Help me decide',
            default       => $this->country ?? '—',
        };
    }
}
