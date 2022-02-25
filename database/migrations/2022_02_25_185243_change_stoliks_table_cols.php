<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStoliksTableCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stoliks', function (Blueprint $table) {
            $table->integer("waiter_id")->nullable()->change();
            $table->string("waiter_name")->nullable()->change();
            $table->boolean("taken")->nullable()->change();
            $table->integer("order_id")->nullable()->change();
            $table->time("taken_at")->nullable()->change();
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
