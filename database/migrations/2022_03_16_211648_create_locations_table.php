<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->string('street');
            $table->string('zip_code',100)->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',30)->nullable();
            $table->string('country')->nullable();
            $table->float('lat',10,7)->index()->nullable();
            $table->float('lng',11,7)->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['lat', 'lng']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
