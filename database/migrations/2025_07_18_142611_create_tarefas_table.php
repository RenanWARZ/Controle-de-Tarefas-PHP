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
    Schema::create('tarefas', function (Blueprint $table) {
    $table->id();
    $table->string('task');
    $table->text('descricao')->nullable();
    $table->date('prazo');
    $table->date('prazofinal');
    $table->boolean('concluida')->default(false);
    $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('set null');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
