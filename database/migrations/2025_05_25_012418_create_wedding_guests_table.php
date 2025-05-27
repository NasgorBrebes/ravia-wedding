<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wedding_guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('relationship', ['keluarga', 'teman', 'rekan_kerja', 'lainnya']);
            $table->enum('attendance', ['hadir', 'tidak_hadir', 'belum_konfirmasi'])->default('belum_konfirmasi');
            $table->text('message')->nullable();
            $table->timestamp('rsvp_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wedding_guests');
    }
};
