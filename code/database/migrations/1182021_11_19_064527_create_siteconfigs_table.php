<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteconfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteconfigs', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->nullable();
            $table->string('slogan')->nullable();
            $table->string('description')->nullable();
            $table->string('disclaimer')->nullable();
            $table->string('copyright')->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('notify');
            $table->string('logo');
            $table->string('favicon');

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('robots')->default('noindex,nofollow');

            $table->string('h_trusted')->nullable();
            $table->text('d_trusted')->nullable();

            $table->string('h_wedo')->nullable();
            $table->text('d_wedo')->nullable();

            $table->string('img1_wedo')->nullable();
            $table->string('img2_wedo')->nullable();

            $table->string('h_sol')->nullable();
            $table->string('d_sol')->nullable();
            $table->string('img_sol')->nullable();

            $table->string('h_price')->nullable();
            $table->string('d_price')->nullable();

            $table->string('h_faq')->nullable();
            $table->string('d_faq')->nullable();
            
            $table->string('h_about')->nullable();
            $table->string('d_about')->nullable();

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
        Schema::dropIfExists('siteconfigs');
    }
}
