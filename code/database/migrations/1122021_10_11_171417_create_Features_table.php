<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("name",255);
            $table->boolean("available")->default(1);
			$table->unsignedBigInteger("package_id")->nullable()->index();
			$table->foreign("package_id")->references("id")->on("packages")->onDelete("restrict")->onUpdate("restrict");
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
        Schema::dropIfExists('features');
    }
}
