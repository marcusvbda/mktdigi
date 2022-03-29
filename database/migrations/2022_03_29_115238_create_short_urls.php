<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortUrls extends Migration
{
    public function up()
    {
        Schema::create('short_urls', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('original_url');
            $table->string('due_date');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pixel_short_url', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('short_url_id');
            $table->foreign('short_url_id')
                ->references('id')
                ->on('short_urls');
            $table->unsignedBigInteger('pixel_id');
            $table->foreign('pixel_id')
                ->references('id')
                ->on('pixels');
        });

        Schema::create('short_urls_clicks', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pixel_id');
            $table->foreign('pixel_id')
                ->references('id')
                ->on('pixels');
            $table->jsonb('data');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('short_urls_clicks');
        Schema::dropIfExists('short_urls_pixels');
        Schema::dropIfExists('short_urls');
    }
}
