<?php
// app/Http/Controllers/Admin/WeddingSettingController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingSetting;
use App\Models\WeddingStory;
use App\Models\WeddingGallery;
use App\Models\WeddingBankAccount;
use App\Models\WeddingGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeddingSettingController extends Controller
{
    public function index(){
        return view('admin.setting');
    }
    public function dashboard()
    {
        // Basic statistics
        $stats = [
            'total_guests' => WeddingGuest::count(),
            'confirmed_guests' => WeddingGuest::attending()->count(),
            'declined_guests' => WeddingGuest::notAttending()->count(),
            'pending_guests' => WeddingGuest::pending()->count(),
        ];

        // Calculate percentages
        $stats['confirmed_percentage'] = $stats['total_guests'] > 0
            ? round(($stats['confirmed_guests'] / $stats['total_guests']) * 100, 1)
            : 0;

        $stats['response_rate'] = $stats['total_guests'] > 0
            ? round((($stats['confirmed_guests'] + $stats['declined_guests']) / $stats['total_guests']) * 100, 1)
            : 0;

        // Recent activities
        $recent_activities = WeddingGuest::getRecentActivities(10);

        // Statistics by relationship
        $stats_by_relationship = WeddingGuest::getStatsByRelationship();

        // Chart data for attendance
        $attendance_chart_data = [
            'labels' => ['Hadir', 'Tidak Hadir', 'Belum Konfirmasi'],
            'data' => [
                $stats['confirmed_guests'],
                $stats['declined_guests'],
                $stats['pending_guests']
            ],
            'colors' => ['#28a745', '#dc3545', '#ffc107']
        ];

        // Chart data for relationship breakdown
        $relationship_data = WeddingGuest::selectRaw('relationship, COUNT(*) as count')
            ->groupBy('relationship')
            ->get();

        $relationship_chart_data = [
            'labels' => $relationship_data->pluck('relationship')->map(function($rel) {
                return match($rel) {
                    'keluarga' => 'Keluarga',
                    'teman' => 'Teman',
                    'rekan_kerja' => 'Rekan Kerja',
                    'lainnya' => 'Lainnya',
                    default => 'Lainnya'
                };
            })->toArray(),
            'data' => $relationship_data->pluck('count')->toArray(),
            'colors' => ['#007bff', '#28a745', '#ffc107', '#dc3545']
        ];

        // Monthly RSVP trend (last 6 months)
        $monthly_rsvp = WeddingGuest::whereNotNull('rsvp_date')
            ->where('rsvp_date', '>=', Carbon::now()->subMonths(6))
            ->selectRaw('DATE_FORMAT(rsvp_date, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recent_activities',
            'stats_by_relationship',
            'attendance_chart_data',
            'relationship_chart_data',
            'monthly_rsvp'
        ));
    }

    // API endpoints for AJAX calls
    public function getGuestStats()
    {
        $stats = [
            'total_guests' => WeddingGuest::count(),
            'confirmed_guests' => WeddingGuest::attending()->count(),
            'declined_guests' => WeddingGuest::notAttending()->count(),
            'pending_guests' => WeddingGuest::pending()->count(),
        ];

        $stats['confirmed_percentage'] = $stats['total_guests'] > 0
            ? round(($stats['confirmed_guests'] / $stats['total_guests']) * 100, 1)
            : 0;

        return response()->json($stats);
    }

    public function getRecentActivities()
    {
        $activities = WeddingGuest::getRecentActivities(15);

        return response()->json([
            'data' => $activities->map(function($guest) {
                return [
                    'id' => $guest->id,
                    'name' => $guest->name,
                    'attendance' => $guest->attendance_label,
                    'badge_color' => $guest->status_badge,
                    'rsvp_date' => $guest->rsvp_date->diffForHumans(),
                    'relationship' => $guest->relationship_label,
                    'message_preview' => $guest->message ? \Str::limit($guest->message, 50) : null
                ];
            })
        ]);
    }

    public function getAttendanceChart()
    {
        $stats = [
            'confirmed' => WeddingGuest::attending()->count(),
            'declined' => WeddingGuest::notAttending()->count(),
            'pending' => WeddingGuest::pending()->count(),
        ];

        return response()->json([
            'labels' => ['Hadir', 'Tidak Hadir', 'Belum Konfirmasi'],
            'datasets' => [[
                'data' => array_values($stats),
                'backgroundColor' => ['#28a745', '#dc3545', '#ffc107'],
                'borderWidth' => 2
            ]]
        ]);
    }

    public function getRelationshipChart()
    {
        $data = WeddingGuest::selectRaw('relationship, COUNT(*) as count')
            ->groupBy('relationship')
            ->get();

        $labels = $data->pluck('relationship')->map(function($rel) {
            return match($rel) {
                'keluarga' => 'Keluarga',
                'teman' => 'Teman',
                'rekan_kerja' => 'Rekan Kerja',
                'lainnya' => 'Lainnya',
                default => 'Lainnya'
            };
        })->toArray();

        return response()->json([
            'labels' => $labels,
            'datasets' => [[
                'data' => $data->pluck('count')->toArray(),
                'backgroundColor' => ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                'borderWidth' => 2
            ]]
        ]);
    }

    public function exportGuestList()
    {
        $guests = WeddingGuest::orderBy('name')->get();

        $csv = "Name,Email,Phone,Relationship,Attendance,RSVP Date,Message\n";

        foreach($guests as $guest) {
            $csv .= sprintf(
                '"%s","%s","%s","%s","%s","%s","%s"' . "\n",
                $guest->name,
                $guest->email ?? '',
                $guest->phone ?? '',
                $guest->relationship_label,
                $guest->attendance_label,
                $guest->rsvp_date ? $guest->rsvp_date->format('Y-m-d H:i:s') : '',
                str_replace('"', '""', $guest->message ?? '')
            );
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="guest_list_' . date('Y-m-d') . '.csv"');
    }

    // Keep existing methods...
    public function heroSection()
    {
        $settings = WeddingSetting::whereIn('key', [
            'hero_title', 'hero_subtitle', 'hero_image'
        ])->get()->pluck('value', 'key');

        return response()->json([
            'hero_title' => $settings['hero_title'] ?? '',
            'hero_subtitle' => $settings['hero_subtitle'] ?? '',
            'hero_image' => $settings['hero_image'] ?? '',
        ]);
    }

    public function updateHeroSection(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::transaction(function () use ($request) {
            WeddingSetting::setSetting('hero_title', $request->hero_title);
            WeddingSetting::setSetting('hero_subtitle', $request->hero_subtitle);

            if ($request->hasFile('hero_image')) {
                $oldImage = WeddingSetting::getSetting('hero_image');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }

                $path = $request->file('hero_image')->store('wedding/hero', 'public');
                WeddingSetting::setSetting('hero_image', $path, 'image');
            }
        });

        return response()->json(['success' => true, 'message' => 'Hero section berhasil diupdate']);
    }

    public function homeSection()
    {
        $settings = WeddingSetting::whereIn('key', [
            'home_image', 'home_quote', 'home_quote_source'
        ])->get()->pluck('value', 'key');

        return response()->json([
            'home_image' => $settings['home_image'] ?? '',
            'home_quote' => $settings['home_quote'] ?? '',
            'home_quote_source' => $settings['home_quote_source'] ?? '',
        ]);
    }

    public function updateHomeSection(Request $request)
    {
        $request->validate([
            'home_quote' => 'required|string',
            'home_quote_source' => 'required|string|max:255',
            'home_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::transaction(function () use ($request) {
            WeddingSetting::setSetting('home_quote', $request->home_quote);
            WeddingSetting::setSetting('home_quote_source', $request->home_quote_source);

            if ($request->hasFile('home_image')) {
                $oldImage = WeddingSetting::getSetting('home_image');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }

                $path = $request->file('home_image')->store('wedding/home', 'public');
                WeddingSetting::setSetting('home_image', $path, 'image');
            }
        });

        return response()->json(['success' => true, 'message' => 'Home section berhasil diupdate']);
    }

    public function mempelaiSection()
    {
        $settings = WeddingSetting::whereIn('key', [
            'groom_name', 'groom_parents', 'groom_address', 'groom_photo',
            'bride_name', 'bride_parents', 'bride_address', 'bride_photo'
        ])->get()->pluck('value', 'key');

        return response()->json($settings->toArray());
    }
}
