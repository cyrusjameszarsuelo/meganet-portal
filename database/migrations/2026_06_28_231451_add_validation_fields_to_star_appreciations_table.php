<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValidationFieldsToStarAppreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('star_appreciations', function (Blueprint $table) {
            $table->enum('validation_status', ['valid', 'not_valid'])->nullable()->default(null)->after('from_email');
            $table->timestamp('validated_at')->nullable()->default(null)->after('validation_status');
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
            $table->dropColumn(['validation_status', 'validated_at']);
        });
    }
}
