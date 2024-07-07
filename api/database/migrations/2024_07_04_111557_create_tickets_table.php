<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('type');
            $table->integer('quantity'); // Updated from 'number of seats' to 'quantity'
            $table->decimal('price', 8, 2);
            $table->timestamps();
    
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
