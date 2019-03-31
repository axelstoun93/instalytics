<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeInstagramAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instagram_account',function (Blueprint $table) {
            $table->integer('bots')->after('media_count')->dafault(0);
            $table->integer('category_id')->unsigned()->after('promotion')->nullable();
            $table->foreign('category_id')->references('id')->on('instagram_account_category');
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
