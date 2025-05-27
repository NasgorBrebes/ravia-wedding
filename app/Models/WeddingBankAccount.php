<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingBankAccount extends Model
{
    use HasFactory;

    protected $fillable = ['bank_name', 'account_holder', 'account_number', 'bank_logo', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
