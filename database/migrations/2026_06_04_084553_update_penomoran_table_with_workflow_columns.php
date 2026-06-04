<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penomoran', function (Blueprint $table) {
            // 1. user_id (FK ke users - untuk track siapa yang buat)
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');

            // 2. pengguna_jasa_id (FK ke users, nullable - untuk role pengguna_jasa)
            $table->foreignId('pengguna_jasa_id')->nullable()->after('user_id')->constrained('users')->onDelete('set null');

            // 3. staff_id (FK ke users, nullable - untuk role staff)
            $table->foreignId('staff_id')->nullable()->after('pengguna_jasa_id')->constrained('users')->onDelete('set null');

            // 4. status_pengajuan (enum: 'draft', 'pending_staff', 'selesai') - default 'draft'
            $table->enum('status_pengajuan', ['draft', 'pending_staff', 'selesai'])->default('draft')->after('tanggal_pibk');

            // 5. data_halaman_pengguna_jasa (JSON, nullable) - untuk tracking apa aja yang diisi pengguna_jasa
            $table->json('data_halaman_pengguna_jasa')->nullable()->after('status_pengajuan');

            // 6. data_halaman_staff (JSON, nullable) - untuk tracking apa aja yang diisi staff
            $table->json('data_halaman_staff')->nullable()->after('data_halaman_pengguna_jasa');

            // 7. submitted_by_pengguna_at (timestamp, nullable) - kapan pengguna_jasa submit
            $table->timestamp('submitted_by_pengguna_at')->nullable()->after('data_halaman_staff');

            // 8. completed_by_staff_at (timestamp, nullable) - kapan staff selesai
            $table->timestamp('completed_by_staff_at')->nullable()->after('submitted_by_pengguna_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penomoran', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['pengguna_jasa_id']);
            $table->dropForeign(['staff_id']);
            
            $table->dropColumn([
                'user_id',
                'pengguna_jasa_id',
                'staff_id',
                'status_pengajuan',
                'data_halaman_pengguna_jasa',
                'data_halaman_staff',
                'submitted_by_pengguna_at',
                'completed_by_staff_at'
            ]);
        });
    }
};
