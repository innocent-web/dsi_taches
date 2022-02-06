<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDoneFieldWithDefaultValueTableTache extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taches', function (Blueprint $table) {
            $table->boolean('done')->default(0)->change();
            $table->boolean('done')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taches', function (Blueprint $table) {
            $table->boolean('done')->default(null)->change();
            $table->boolean('done')->nullable(false)->change();
        }); 
    }
}
