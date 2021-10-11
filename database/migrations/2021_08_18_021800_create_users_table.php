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
            $table->unsignedBigInteger('id', true);
            $table->integer('user_id')->default(0000);
            $table->integer('status')->default(0);
            $table->integer('role')->default(0);
            $table->integer('staff_status')->default(0);
            $table->string('name');
            $table->text('kana')->nullable();
            $table->integer('gender')->default(0);
            $table->date('birthday')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('post_code')->nullable();
            $table->text('address')->nullable();
            $table->text('home_tell')->nullable();
            $table->text('office_tell')->nullable();
            $table->integer('start_time')->nullable();
            $table->integer('last_time')->nullable();
            $table->date('first_day')->nullable();
            $table->date('last_day')->nullable();
            $table->longtext('memo')->nullable();
            $table->string('profile_image')->default('default.png');
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
