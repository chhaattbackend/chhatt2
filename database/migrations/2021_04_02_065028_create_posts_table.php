<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('User_id')->nullable();
            $table->integer('office_id')->nullable();
            $table->integer('client_id');
            $table->integer('post_click')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->text('url');
            $table->tinyInteger('soft_delete')->nullable()->default(0);
            $table->tinyInteger('post_sold')->default(0);
            $table->text('user_name');
            $table->integer('post_detail_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->string('country')->default('Pakistan');
            $table->string('region')->default('South');
            $table->string('state')->default('4');
            $table->text('address')->nullable();
            $table->text('city')->nullable();
            $table->integer('web_post')->nullable()->default(0);
            $table->text('post_descrip')->nullable();
            $table->text('latlng');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('major_area')->nullable()->default('DHA');
            $table->string('minor_area')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->text('apu')->nullable();
            $table->text('bath')->nullable();
            $table->text('bed')->nullable();
            $table->text('cat_id')->nullable();
            $table->text('phone')->nullable();
            $table->double('price')->nullable();
            $table->text('p_type')->nullable();
            $table->string('s_price')->nullable();
            $table->text('corner')->nullable();
            $table->text('amunities')->nullable();
            $table->text('squ')->nullable();
            $table->integer('plt')->nullable();
            $table->text('p_for')->nullable();
            $table->text('listtype')->nullable();
            $table->text('user_image')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('image')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('ext_a')->nullable();
            $table->string('ext_b')->nullable();
            $table->text('features')->nullable();
            $table->text('free_txt')->nullable();
            $table->text('facing')->nullable();
            $table->integer('likes')->nullable()->default(0);
            $table->integer('views')->nullable()->default(0);
            $table->integer('view_id')->nullable();
            $table->tinyInteger('user_posted')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
