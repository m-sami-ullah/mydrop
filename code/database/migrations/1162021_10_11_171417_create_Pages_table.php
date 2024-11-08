<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("name",255);
			$table->longText("description");
			$table->string("image",255)->nullable();
			$table->string("meta_title",255)->nullable();
			$table->string("keywords",255)->nullable();
			$table->text("meta_description")->nullable();
			$table->string("robots",255)->nullable();
			$table->boolean("status")->default(1)->nullable();
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
        Schema::dropIfExists('pages');
    }
}
