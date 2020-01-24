<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentAndSon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->nullable()->default(null)->after('sponsorship');
            $table->foreign('parent_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->integer('son_id')->unsigned()->nullable()->default(null)->after('parent_id');
            $table->foreign('son_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
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
