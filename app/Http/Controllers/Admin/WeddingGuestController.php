<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingGuest;
use Illuminate\Http\Request;

class WeddingGuestController extends Controller
{
    public function index(Request $request)
    {
        $query = WeddingGuest::query();

        // Filter by attendance
        if ($request->filled('attendance')) {
            $query->where('attendance', $request->attendance);
        }

        // Filter by relationship
        if ($request->filled('relationship')) {
            $query->where('relationship', $request->relationship);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $guests = $query->orderBy('created_at', 'desc')->paginate(20);

        // Statistics
        $stats = [
            'total' => WeddingGuest::count(),
            'hadir' => WeddingGuest::attending()->count(),
            'tidak_hadir' => WeddingGuest::notAttending()->count(),
            'belum_konfirmasi' => WeddingGuest::pending()->count(),
        ];

        return view('admin.guests.index', compact('guests', 'stats'));
    }

    public function create()
    {
        return view('admin.guests.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'relationship' => 'required|in:keluarga,teman,rekan_kerja,lainnya',
            'attendance' => 'required|in:hadir,tidak_hadir,belum_konfirmasi',
            'message' => 'nullable|string',
        ]);

        if ($validatedData['attendance'] !== 'belum_konfirmasi') {
            $validatedData['rsvp_date'] = now();
        }

        WeddingGuest::create($validatedData);

        return redirect()->route('admin.guests.index')
            ->with('success', 'Tamu berhasil ditambahkan!');
    }

    public function show(WeddingGuest $guest)
    {
        return view('admin.guests.show', compact('guest'));
    }

    public function edit(WeddingGuest $guest)
    {
        return view('admin.guests.edit', compact('guest'));
    }

    public function update(Request $request, WeddingGuest $guest)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'relationship' => 'required|in:keluarga,teman,rekan_kerja,lainnya',
            'attendance' => 'required|in:hadir,tidak_hadir,belum_konfirmasi',
            'message' => 'nullable|string',
        ]);

        // Update RSVP date if attendance status changed
        if ($guest->attendance !== $validatedData['attendance'] && $validatedData['attendance'] !== 'belum_konfirmasi') {
            $validatedData['rsvp_date'] = now();
        } elseif ($validatedData['attendance'] === 'belum_konfirmasi') {
            $validatedData['rsvp_date'] = null;
        }

        $guest->update($validatedData);

        return redirect()->route('admin.guests.index')
            ->with('success', 'Data tamu berhasil diperbarui!');
    }

    public function destroy(WeddingGuest $guest)
    {
        $guest->delete();

        return redirect()->route('admin.guests.index')
            ->with('success', 'Tamu berhasil dihapus!');
    }

    public function export(Request $request)
    {
        $guests = WeddingGuest::all();

        $filename = 'wedding_guests_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($guests) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, [
                'Nama',
                'Email',
                'Telepon',
                'Hubungan',
                'Kehadiran',
                'Pesan',
                'Tanggal RSVP',
                'Tanggal Dibuat'
            ]);

            // Data
            foreach ($guests as $guest) {
                fputcsv($file, [
                    $guest->name,
                    $guest->email,
                    $guest->phone,
                    ucfirst(str_replace('_', ' ', $guest->relationship)),
                    ucfirst(str_replace('_', ' ', $guest->attendance)),
                    $guest->message,
                    $guest->rsvp_date ? $guest->rsvp_date->format('Y-m-d H:i:s') : '',
                    $guest->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,update_attendance',
            'selected_guests' => 'required|array',
            'selected_guests.*' => 'exists:wedding_guests,id',
            'attendance' => 'required_if:action,update_attendance|in:hadir,tidak_hadir,belum_konfirmasi'
        ]);

        $guestIds = $request->selected_guests;

        switch ($request->action) {
            case 'delete':
                WeddingGuest::whereIn('id', $guestIds)->delete();
                $message = 'Tamu terpilih berhasil dihapus!';
                break;

            case 'update_attendance':
                $updateData = ['attendance' => $request->attendance];
                if ($request->attendance !== 'belum_konfirmasi') {
                    $updateData['rsvp_date'] = now();
                } else {
                    $updateData['rsvp_date'] = null;
                }

                WeddingGuest::whereIn('id', $guestIds)->update($updateData);
                $message = 'Status kehadiran tamu berhasil diperbarui!';
                break;
        }

        return redirect()->route('admin.guests.index')
            ->with('success', $message);
    }
}
