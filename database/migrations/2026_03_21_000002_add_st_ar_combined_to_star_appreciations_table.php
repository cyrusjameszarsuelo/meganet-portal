<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStArCombinedToStarAppreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('star_appreciations', function (Blueprint $table) {
            $table->text('situation_task')->nullable()->after('thanks_for');
            $table->text('action_results')->nullable()->after('situation_task');
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
            $table->dropColumn(['situation_task', 'action_results']);
        });
    }
}
