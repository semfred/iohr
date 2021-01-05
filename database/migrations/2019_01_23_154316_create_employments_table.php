<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->integer('position_id')->unsigned()->nullable();
            $table->integer('working_hrs')->unsigned()->nullable();
            $table->integer('immediate_mngr')->unsigned()->nullable();
            $table->integer('approving_mngr')->unsigned()->nullable();
            $table->timestamp('onboard_date')->nullable();
            $table->boolean('employed')->default(1);
            $table->timestamp('offboard_date')->nullable();
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
        Schema::dropIfExists('employments');
    }
}
