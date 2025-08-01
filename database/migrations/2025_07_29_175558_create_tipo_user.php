<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_user', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->unique();
            $table->timestamps();

        });

        DB::table('tipo_user')->insert([
          ['id'=> 0,'descricao' => 'Usuário'],
          ['id'=> 1,'descricao' => 'Administrador'],

        ]);
    }

    /**
     * Reverse the migrat
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_user');
    }
};
