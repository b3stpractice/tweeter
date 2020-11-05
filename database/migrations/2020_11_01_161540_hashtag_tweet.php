<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HashtagTweet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_tweet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hashtag_id');
            $table->foreign('hashtag_id')->references('id')
              ->on('hashtags')->onDelete('cascade');
            $table->unsignedBigInteger('tweet_id');
            $table->foreign('tweet_id')->references('id')
              ->on('tweets')->onDelete('cascade');
            $table->softDeletes();
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
        //
    }
}
