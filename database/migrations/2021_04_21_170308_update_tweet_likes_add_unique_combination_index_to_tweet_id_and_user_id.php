<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTweetLikesAddUniqueCombinationIndexToTweetIdAndUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tweet_likes', function (Blueprint $table) {
            $table->unique(['tweet_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tweet_likes', function (Blueprint $table) {
            $table->dropUnique(['tweet_id', 'user_id']);
        });
    }
}
