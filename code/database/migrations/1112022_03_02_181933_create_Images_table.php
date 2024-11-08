<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("name",255)->nullable();
			$table->string("status",1);
			$table->unsignedBigInteger("customer_id")->nullable()->index();
			$table->foreign("customer_id")->references("id")->on("customers")->onDelete("restrict")->onUpdate("restrict");
			$table->unsignedBigInteger("box_id")->nullable()->index();
			$table->foreign("box_id")->references("id")->on("boxes")->onDelete("restrict")->onUpdate("restrict");
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
        Schema::dropIfExists('images');
    }
}
