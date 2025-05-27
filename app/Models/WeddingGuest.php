<?php
// app/Models/WeddingGuest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WeddingGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'relationship',
        'attendance',
        'message',
        'rsvp_date'
    ];

    protected $casts = [
        'rsvp_date' => 'datetime'
    ];

    // Scope untuk tamu yang hadir
    public function scopeAttending($query)
    {
        return $query->where('attendance', 'hadir');
    }

    // Scope untuk tamu yang tidak hadir
    public function scopeNotAttending($query)
    {
        return $query->where('attendance', 'tidak_hadir');
    }

    // Scope untuk tamu yang belum konfirmasi
    public function scopePending($query)
    {
        return $query->where('attendance', 'belum_konfirmasi');
    }

    // Scope untuk tamu yang sudah RSVP
    public function scopeRsvped($query)
    {
        return $query->whereNotNull('rsvp_date');
    }

    // Accessor untuk status badge color
    public function getStatusBadgeAttribute()
    {
        return match($this->attendance) {
            'hadir' => 'success',
            'tidak_hadir' => 'danger',
            'belum_konfirmasi' => 'warning',
            default => 'secondary'
        };
    }

    // Accessor untuk relationship label
    public function getRelationshipLabelAttribute()
    {
        return match($this->relationship) {
            'keluarga' => 'Keluarga',
            'teman' => 'Teman',
            'rekan_kerja' => 'Rekan Kerja',
            'lainnya' => 'Lainnya',
            default => 'Tidak Diketahui'
        };
    }

    // Accessor untuk attendance label
    public function getAttendanceLabelAttribute()
    {
        return match($this->attendance) {
            'hadir' => 'Hadir',
            'tidak_hadir' => 'Tidak Hadir',
            'belum_konfirmasi' => 'Belum Konfirmasi',
            default => 'Unknown'
        };
    }

    // Method untuk mendapatkan statistik per relationship
    public static function getStatsByRelationship()
    {
        return self::selectRaw('relationship, attendance, COUNT(*) as count')
            ->groupBy('relationship', 'attendance')
            ->get()
            ->groupBy('relationship');
    }

    // Method untuk mendapatkan statistik per bulan
    public static function getMonthlyStats()
    {
        return self::whereNotNull('rsvp_date')
            ->selectRaw('MONTH(rsvp_date) as month, YEAR(rsvp_date) as year, COUNT(*) as count')
            ->groupBy('month', 'year')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    }

    // Method untuk recent activities
    public static function getRecentActivities($limit = 10)
    {
        return self::whereNotNull('rsvp_date')
            ->orderBy('rsvp_date', 'desc')
            ->limit($limit)
            ->get();
    }
}
