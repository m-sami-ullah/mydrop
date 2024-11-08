<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxdevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxdevices', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->unsignedBigInteger("box_id")->index();
			$table->foreign("box_id")->references("id")->on("boxes")->onDelete("restrict")->onUpdate("restrict");
			$table->unsignedBigInteger("device_id")->index();
			$table->foreign("device_id")->references("id")->on("devices")->onDelete("restrict")->onUpdate("restrict");
			$table->string("status",1);
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
        Schema::dropIfExists('boxdevices');
    }
}
