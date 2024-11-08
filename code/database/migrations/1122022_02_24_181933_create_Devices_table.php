<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("name",255);
            $table->string("deviceid",255);
            $table->string("ip",255);
            $table->string("model",255);
            $table->date("installdate");
            $table->boolean("installed")->default(0);
            // $table->date("type")->;
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
        Schema::dropIfExists('devices');
    }
}
