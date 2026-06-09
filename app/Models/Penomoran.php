<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penomoran extends Model
{
    use HasFactory;

    protected $table = 'penomoran';

    protected $fillable = [
        'penomoran',
        'tanggal_pibk',
        'user_id',
        'pengguna_jasa_id',
        'staff_id',
        'status_pengajuan',
        'submitted_by_pengguna_at',
        'completed_by_staff_at',
    ];

    protected $casts = [
        'penomoran' => 'integer',
        'tanggal_pibk' => 'date',
        'submitted_by_pengguna_at' => 'datetime',
        'completed_by_staff_at' => 'datetime',
    ];

    public function getFormattedPenomoranAttribute(): ?string
    {
        if ($this->penomoran === null) {
            return null;
        }

        return str_pad((string) $this->penomoran, 6, '0', STR_PAD_LEFT);
    }

    public function getDisplayKotaPibkAttribute(): ?string
    {
        $kota = $this->uraianBarangs
            ->first(function ($item) {
                return filled($item->kota_pibk) && !preg_match('/^[0-9]+$/', trim($item->kota_pibk));
            });

        return $kota ? trim($kota->kota_pibk) : null;
    }

    // Atribut progress untuk dashboard
    public function getCompletedStepsAttribute()
    {
        $steps = 1;

        if ($this->pengirim && $this->penerima) {
            $steps++;
        }

        if ($this->pemberitahu && $this->suratIzin) {
            $steps++;
        }

        if ($this->pengangkutan) {
            $steps++;
        }

        if ($this->pib) {
            $steps++;
        }

        if ($this->uraianBarangs && $this->uraianBarangs->count() > 0) {
            $steps++;
        }

        if ($this->pemeriksaan) {
            $steps++;
        }

        if ($this->pfpd && $this->pemeriksa && $this->jaminan) {
            $steps++;
        }

        if ($steps === 8 && $this->pfpd && $this->pemeriksa && $this->jaminan) {
            $steps = 9;
        }

        return min(max($steps, 1), 9);
    }

    public function getProgressPercentageAttribute()
    {
        return (int) round(($this->completed_steps / 9) * 100);
    }

    public function getProgressLabelAttribute()
    {
        if ($this->progress_percentage === 100) {
            return 'Selesai';
        }

        if ($this->progress_percentage >= 80) {
            return 'Hampir Selesai';
        }

        if ($this->progress_percentage >= 50) {
            return 'Sedang Berjalan';
        }

        return 'Baru Dibuat';
    }

    // Relationships
    public function pengirim()
    {
        return $this->hasOne(Pengirim::class);
    }

    public function penerima()
    {
        return $this->hasOne(Penerima::class);
    }

    public function pemberitahu()
    {
        return $this->hasOne(Pemberitahu::class);
    }

    public function suratIzin()
    {
        return $this->hasOne(SuratIzin::class);
    }

    public function pengangkutan()
    {
        return $this->hasOne(Pengangkutan::class);
    }

    public function pib()
    {
        return $this->hasOne(Pib::class);
    }

    public function uraianBarangs()
    {
        return $this->hasMany(UraianBarang::class);
    }

    public function uraianBarang()
    {
        return $this->hasOne(UraianBarang::class);
    }

    public function pfpd()
    {
        return $this->hasOne(Pfpd::class);
    }

    public function pemeriksa()
    {
        return $this->hasOne(Pemeriksa::class);
    }

    public function jaminan()
    {
        return $this->hasOne(Jaminan::class);
    }

    public function pemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::class);
    }
    
    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function penggunaJasa()
    {
        return $this->belongsTo(\App\Models\User::class, 'pengguna_jasa_id');
    }

    public function staffPetugas()
    {
        return $this->belongsTo(\App\Models\User::class, 'staff_id');
    }
}