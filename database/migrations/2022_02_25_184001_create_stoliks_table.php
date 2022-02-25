<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoliksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoliks', function (Blueprint $table) {
            $table->id();
            $table->integer("xCoord")->default(0);
            $table->integer("yCoord")->default(0);
            $table->integer("waiter_id")->default(0);
            $table->string("waiter_name")->default('');
            $table->boolean("taken")->default(false);
            $table->integer("order_id")->default(null);
            $table->time("taken_on")->default(null);
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
        Schema::dropIfExists('stoliks');
    }
}
