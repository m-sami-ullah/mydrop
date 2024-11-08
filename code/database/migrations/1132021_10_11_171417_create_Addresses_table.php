<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("title",255);
			$table->unsignedBigInteger("state_id")->index();
			$table->foreign("state_id")->references("id")->on("states")->onDelete("restrict")->onUpdate("restrict");
			$table->unsignedBigInteger("city_id")->index();
			$table->foreign("city_id")->references("id")->on("cities")->onDelete("restrict")->onUpdate("restrict");
			$table->unsignedBigInteger("area_id")->index();
			$table->foreign("area_id")->references("id")->on("areas")->onDelete("restrict")->onUpdate("restrict");
			$table->string("postcode",20)->nullable();
			$table->text("saddress")->nullable();
			$table->unsignedBigInteger("customer_id")->nullable()->index();
			$table->foreign("customer_id")->references("id")->on("customers")->onDelete("restrict")->onUpdate("restrict");
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
        Schema::dropIfExists('addresses');
    }
}
