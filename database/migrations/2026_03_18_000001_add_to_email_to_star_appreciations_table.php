<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToEmailToStarAppreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('star_appreciations', function (Blueprint $table) {
            $table->string('to_email')->nullable()->after('to_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('star_appreciations', function (Blueprint $table) {
            $table->dropColumn('to_email');
        });
    }
}
