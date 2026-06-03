<?php

namespace App\Models;

use App\Models\Penomoran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pib extends Model
{
    use HasFactory;

    protected $table = 'pib';

    protected $fillable = [
        'penomoran_id',
        'nomor_bc11',
        'tanggal_bc11',
        'nomor_pos',
        'invoice',
        'tanggal_invoice',
        'nomor_bl_awb',
        'tanggal_bl_awb',
        'negara_asal_barang',
        'valuta',
        'fob',
        'freight',
        'freight_currency',
        'asuransi',
        'nilai_cif',
    ];

    protected $casts = [
        'tanggal_bc11' => 'date',
        'tanggal_invoice' => 'date',
        'tanggal_bl_awb' => 'date',
        'fob' => 'decimal:2',
        'freight' => 'decimal:2',
        'asuransi' => 'decimal:2',
        'nilai_cif' => 'decimal:2',
    ];

    public function formatDecimal($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = (string) $value;

        if (str_contains($value, '.')) {
            $value = rtrim(rtrim($value, '0'), '.');
        }

        return str_replace('.', ',', $value);
    }

    public function penomoran()
    {
        return $this->belongsTo(Penomoran::class, 'penomoran_id');
    }
}
