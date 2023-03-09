<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id')->unsigned();
            $table->string('title',100);
            $table->string('city',100);
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->date('bookDate')->nullable();
            $table->date('checkout')->nullable();
            $table->integer('lenght')->nullable();
            $table->decimal('price', 6, 2)->unsigned();
            $table->string('photo', 200)->nullable();
            $table->text('des')->nullable();
            $table->foreign('hotel_id')->references('id')->on('hotels');
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
        Schema::dropIfExists('countries');
    }
};