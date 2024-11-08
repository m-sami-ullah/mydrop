<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("firstname",255);
			$table->string("lastname",255);
			$table->string("email",255);
			$table->string("password",255);
			$table->string("phone",255)->nullable();
			$table->string("status",50)->nullable();
			$table->timestamp("lastlogin")->nullable();
			$table->string("ip",100)->nullable();
			$table->string("signup",30)->nullable();
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
        Schema::dropIfExists('customers');
    }
}
