<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('cedula',10)->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefono',25)->nullable();
            $table->datetime('fecha_nac')->nullable();
            $table->foreignId('rol_id')->default(1);
            $table->boolean('propietario')->default(true);
            $table->boolean('status')->default(true);
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
