<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wedding_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image_url');
            $table->string('thumbnail_url')->nullable();
            $table->string('alt_text');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wedding_galleries');
    }
};
