<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("name",255)->nullable();
			$table->unsignedBigInteger("city_id")->nullable()->index();
			$table->foreign("city_id")->references("id")->on("cities")->onDelete("restrict")->onUpdate("restrict");
			$table->unsignedBigInteger("state_id")->nullable()->index();
			$table->foreign("state_id")->references("id")->on("states")->onDelete("restrict")->onUpdate("restrict");
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
        Schema::dropIfExists('areas');
    }
}
