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
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id_task');
            $table->string('title', 100)->nullable(false);
            $table->string('description', 255);
            $table->string('category', 50);
            $table->integer('priority')->default(1);
            $table->date('due_date')->nullable(false);
            $table->boolean('is_completed')->default(false)->nullable(false);
            $table->binary('arquivo')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

        DB::statement('ALTER TABLE tasks MODIFY arquivo LONGBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
