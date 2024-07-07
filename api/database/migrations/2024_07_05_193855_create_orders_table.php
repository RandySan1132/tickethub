<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('listing_id')->constrained('listings')->onDelete('cascade');  // Ensure listing_id is present
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->string('status');
            $table->foreignId('payment_option_id')->constrained('payment_options')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
