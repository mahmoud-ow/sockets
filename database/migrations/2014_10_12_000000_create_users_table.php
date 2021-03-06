<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('language')->nullable();
            $table->string('account_type')->default('buyer');
            $table->string('country')->nullable();
            $table->longtext('website')->nullable();
            $table->string('balance')->default(0);

            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('banned')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
