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
        Schema::dropIfExists('boxes');
        
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("customer_id")->nullable()->index();
            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("restrict")->onUpdate("restrict");
            $table->unsignedBigInteger("address_id")->nullable()->index();
            $table->foreign("address_id")->references("id")->on("addresses")->onDelete("restrict")->onUpdate("restrict");
            
            $table->unsignedBigInteger("switch_id")->nullable()->index();
            $table->foreign("switch_id")->references("id")->on("devices")->onDelete("restrict")->onUpdate("restrict");

            $table->unsignedBigInteger("camera_id")->nullable()->index();
            $table->foreign("camera_id")->references("id")->on("devices")->onDelete("restrict")->onUpdate("restrict");

            $table->string("status")->default(0);

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
