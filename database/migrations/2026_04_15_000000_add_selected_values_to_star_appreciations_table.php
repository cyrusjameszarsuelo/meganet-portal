<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSelectedValuesToStarAppreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('star_appreciations', function (Blueprint $table) {
            $table->text('selected_values')->nullable()->after('action_results');
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
            $table->dropColumn('selected_values');
        });
    }
}