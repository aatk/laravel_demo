<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_d_b_s', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('firstname', 70);
            $table->string('secondname', 70);
            $table->string('surname', 70);
            $table->timestamps();
            //$table->indexCommand(['firstname', 'secondname', 'surname'], "fulltextindex" );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_d_b_s');
    }
}
