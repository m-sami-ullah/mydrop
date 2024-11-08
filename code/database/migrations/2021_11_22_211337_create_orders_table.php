<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("customer_id")->nullable()->index();
            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("restrict")->onUpdate("restrict");
            $table->unsignedBigInteger("address_id")->nullable()->index();
            $table->foreign("address_id")->references("id")->on("addresses")->onDelete("restrict")->onUpdate("restrict");
            $table->unsignedBigInteger("package_id")->nullable()->index();
            $table->foreign("package_id")->references("id")->on("packages")->onDelete("restrict")->onUpdate("restrict");

            $table->string("package",255);
            $table->float("price");
            $table->float("total");
            $table->float("tax");
            $table->string("payment_type");
            $table->string("invoice_number");
            $table->string("invoice_status");
            $table->string("status");

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
        Schema::dropIfExists('orders');
    }
}
