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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->integer("frequency");
            $table->text("string");
            $table->text("result_string")->nullable();
            $table->integer("repetitions");
            $table->string("algorithm");
            $table->string("salt");

            $table->unsignedBigInteger("status")->default(1);
            $table->index("status", "status_idx");
            $table->foreign("status", "status_fk")->on("task_statuses")->references("id");

            $table->unsignedBigInteger("group")->nullable();
            $table->index("group", "group_idx");
            $table->foreign("group", "group_fk")->on("groups")->references("id");

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
        Schema::dropIfExists('tasks');
    }
};
