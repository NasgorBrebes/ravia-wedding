<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WeddingGuest;
use App\Models\WeddingStory;
use App\Models\WeddingGallery;
use App\Models\WeddingBankAccount;
use App\Services\WeddingSettingService;
use Illuminate\Http\Request;

class WeddingController extends Controller
{
    protected $settingService;

    public function __construct(WeddingSettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Show hero section / landing page
     */
    public function index()
    {
        $settings = $this->settingService->getAllSettings();

        return view('wedding.index', compact('settings'));
    }

    /**
     * Show main wedding invitation content
     */
    public function ravia()
    {
        $settings = $this->settingService->getAllSettings();
        $stories = WeddingStory::active()->ordered()->get();
        $galleries = WeddingGallery::active()->ordered()->get();
        $bankAccounts = WeddingBankAccount::active()->get();

        // Count down calculation
        $eventDate = $settings['event_date'] ?? null;
        $countdown = null;

        if ($eventDate) {
            $eventDateTime = \Carbon\Carbon::createFromFormat('Y-m-d', $eventDate);
            if (isset($settings['event_time'])) {
                $eventDateTime = $eventDateTime->setTimeFromTimeString($settings['event_time']);
            }

            if ($eventDateTime->isFuture()) {
                $countdown = [
                    'days' => now()->diffInDays($eventDateTime),
                    'hours' => now()->diffInHours($eventDateTime) % 24,
                    'minutes' => now()->diffInMinutes($eventDateTime) % 60,
                    'seconds' => now()->diffInSeconds($eventDateTime) % 60,
                ];
            }
        }

        return view('wedding.ravia', compact(
            'settings',
            'stories',
            'galleries',
            'bankAccounts',
            'countdown'
        ));
    }

    /**
     * Handle RSVP submission
     */
    public function rsvp(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'relationship' => 'required|in:keluarga,teman,rekan_kerja,lainnya',
            'attendance' => 'required|in:hadir,tidak_hadir',
            'message' => 'nullable|string|max:1000',
        ]);

        $validatedData['rsvp_date'] = now();

        WeddingGuest::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Konfirmasi kehadiran Anda telah diterima.'
        ]);
    }

    /**
     * Get guest messages for display
     */
    public function guestMessages()
    {
        $messages = WeddingGuest::whereNotNull('message')
            ->where('message', '!=', '')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return response()->json($messages);
    }
}
