<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lockers', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("name",255);
			$table->string("deviceid",255);
			$table->string("ip",255);
			$table->string("model",255);
			$table->date("install")->nullable();
			$table->string("channels",10)->nullable();
			$table->string("status",5);
			$table->boolean("installed")->nullable();
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
        Schema::dropIfExists('lockers');
    }
}
