<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarAppreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_appreciations', function (Blueprint $table) {
            $table->id();
            $table->string('to_name');
            $table->string('thanks_for');
            $table->text('situation');
            $table->text('task');
            $table->text('action');
            $table->text('results');
            $table->text('hype_note');
            $table->string('from_name');
            $table->string('from_email')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('star_appreciations');
    }
}
