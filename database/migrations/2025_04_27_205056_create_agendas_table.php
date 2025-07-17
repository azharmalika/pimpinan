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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('user_id')
                   ->constrained('users')
                   ->onDelete('cascade') 
                   ->onUpdate('cascade');
            $table->string('judul');
            $table->datetime('tanggal_mulai');
            $table->enum('prioritas', ['Tinggi', 'Sedang', 'Rendah']);
            $table->string('kategori');
            $table->string('tempat');
            $table->text('deskripsi');
            $table->string('file')->nullable(); 
            $table->string('kehadiran_file')->nullable();
            $table->boolean('is_delegated')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn('is_delegated');
        });
    }
};
