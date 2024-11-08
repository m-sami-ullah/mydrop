<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("title",255)->nullable();
            $table->string("ip",255)->nullable();
            $table->string("boxnumber",255);
			$table->string("qrcode",255)->nullable();
			$table->string("boxtype",1);
			$table->string("status",1);
			$table->unsignedBigInteger("customer_id")->nullable()->index();
			$table->foreign("customer_id")->references("id")->on("customers")->onDelete("restrict")->onUpdate("restrict");
			$table->unsignedBigInteger("address_id")->nullable()->index();
			$table->foreign("address_id")->references("id")->on("addresses")->onDelete("restrict")->onUpdate("restrict");
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
        Schema::dropIfExists('boxes');
    }
}
