<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   

    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('position_number')->nullable();
            $table->integer('subscription_number');
            $table->string('subscriber');
            $table->text('address')->nullable();
            $table->string('counter_number');
            $table->integer('previous_read')->default(0);
            $table->integer('current_read')->default(0);
            $table->integer('cups_consumption')->default(0);
            $table->integer('shekels_consumption')->default(0);
            $table->string('counter_status')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('counters');
    }
}
