<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socials', function (Blueprint $table) {
            $table->id();
            
            
            $table->integer('user_id');
            $table->longText('fb_url')->nullable();
            $table->longText('twt_url')->nullable();
            $table->longText('gplus_url')->nullable();
            $table->longText('rss_url')->nullable();
            $table->longText('db_url')->nullable();
            $table->longText('be_url')->nullable();
            $table->longText('de_url')->nullable();


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
        Schema::dropIfExists('socials');
    }
}
