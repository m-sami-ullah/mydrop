<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("name",255);
			$table->string("btntitle",255)->nullable();
			$table->text("description")->nullable();
			$table->string("status",2)->nullable();
			$table->string("image",255)->nullable();
			$table->string("link",255)->nullable();
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
        Schema::dropIfExists('banners');
    }
}
