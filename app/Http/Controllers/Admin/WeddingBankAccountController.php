<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingBankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeddingBankAccountController extends Controller
{
    public function index()
    {
        $bankAccounts = WeddingBankAccount::all();
        return view('admin.bank-accounts.index', compact('bankAccounts'));
    }

    public function create()
    {
        return view('admin.bank-accounts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'bank_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('bank_logo')) {
            $validatedData['bank_logo'] = $request->file('bank_logo')->store('bank-logos', 'public');
        }

        $validatedData['is_active'] = $request->has('is_active');

        WeddingBankAccount::create($validatedData);

        return redirect()->route('admin.bank-accounts.index')
            ->with('success', 'Rekening bank berhasil ditambahkan!');
    }

    public function show(WeddingBankAccount $bankAccount)
    {
        return view('admin.bank-accounts.show', compact('bankAccount'));
    }

    public function edit(WeddingBankAccount $bankAccount)
    {
        return view('admin.bank-accounts.edit', compact('bankAccount'));
    }

    public function update(Request $request, WeddingBankAccount $bankAccount)
    {
        $validatedData = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'bank_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('bank_logo')) {
            // Delete old logo
            if ($bankAccount->bank_logo) {
                Storage::disk('public')->delete($bankAccount->bank_logo);
            }
            $validatedData['bank_logo'] = $request->file('bank_logo')->store('bank-logos', 'public');
        }

        $validatedData['is_active'] = $request->has('is_active');

        $bankAccount->update($validatedData);

        return redirect()->route('admin.bank-accounts.index')
            ->with('success', 'Rekening bank berhasil diperbarui!');
    }

    public function destroy(WeddingBankAccount $bankAccount)
    {
        if ($bankAccount->bank_logo) {
            Storage::disk('public')->delete($bankAccount->bank_logo);
        }

        $bankAccount->delete();

        return redirect()->route('admin.bank-accounts.index')
            ->with('success', 'Rekening bank berhasil dihapus!');
    }
}
