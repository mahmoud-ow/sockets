<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('user_id')->nullable()->comment('null if universal');
            $table->string('audience')->comment('all, buyer, seller, shop, driver');
            $table->string('language')->comment('user prefered language, this is a multi languages notifications system');
            $table->longText('content', 1000);
            $table->integer('seen')->default(false);
            $table->string('notification_token', 20);
            $table->string('source')->default('system')->comment('system / adminstration');
            $table->integer('order_id')->default(0)->comment('if the notification related to order');
            $table->integer('issue_id')->default(0)->comment('if the notification related to an issue');


            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
