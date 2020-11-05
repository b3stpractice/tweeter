<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Followers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('follower_id')->unsigned();
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('follow_id')->unsigned();
            $table->foreign('follow_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamp('followed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
