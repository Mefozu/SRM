<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('passport_number')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->text('duties')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('passport_number');
            $table->dropColumn('department');
            $table->dropColumn('position');
            $table->dropColumn('duties');
        });
    }
};
