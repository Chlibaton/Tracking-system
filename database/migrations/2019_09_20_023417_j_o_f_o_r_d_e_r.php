<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JOFORDER extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('JOFORDER', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jofno')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('kind_of_ring')->nullable();
            $table->string('date_prepared')->nullable();
            $table->string('due_date')->nullable();
            $table->string('jof_status')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('JOFORDER');
    }
}
