<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('penomoran')) {
            return;
        }

        DB::statement('UPDATE penomoran SET penomoran = CAST(penomoran AS UNSIGNED)');

        Schema::table('penomoran', function (Blueprint $table) {
            $table->unsignedInteger('penomoran')->change();
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('penomoran')) {
            return;
        }

        Schema::table('penomoran', function (Blueprint $table) {
            $table->string('penomoran')->change();
        });
    }
};
