<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingGuest;
use App\Models\WeddingSetting;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $total = WeddingGuest::count();
        $confirmed = WeddingGuest::attending()->count();
        $declined = WeddingGuest::notAttending()->count();
        $pending = WeddingGuest::pending()->count();

        $confirmed_percentage = $total > 0 ? ($confirmed / $total) * 100 : 0;

        $stats = [
            'total_guests' => $total,
            'confirmed_guests' => $confirmed,
            'declined_guests' => $declined,
            'pending_guests' => $pending,
            'confirmed_percentage' => round($confirmed_percentage, 2),
            'response_rate' => 100, // atau hitung sesuai logikamu
        ];

        $recent_activities = WeddingGuest::whereNotNull('rsvp_date')
            ->orderBy('rsvp_date', 'desc')
            ->limit(10)
            ->get();

        // Attendance chart data
        $attendance_chart_data = [
            'labels' => ['Hadir', 'Tidak Hadir', 'Belum Menjawab'],
            'data' => [$confirmed, $declined, $pending],
            'colors' => ['#10b981', '#ef4444', '#fbbf24'], // Hijau, Merah, Kuning
        ];

        // Relationship chart data (misal berdasarkan relasi tamu)
        $relationship_stats = WeddingGuest::select('relationship', DB::raw('count(*) as total'))
            ->groupBy('relationship')
            ->get();

        $relationship_chart_data = [
            'labels' => $relationship_stats->pluck('relationship'),
            'data' => $relationship_stats->pluck('total'),
            'colors' => $relationship_stats->map(function () {
                return sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Random color
            }),
        ];

        return view('admin.dashboard', compact(
            'stats',
            'recent_activities',
            'attendance_chart_data',
            'relationship_chart_data'
        ));
    }

}
