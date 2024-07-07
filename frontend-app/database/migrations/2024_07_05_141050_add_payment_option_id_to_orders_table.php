<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->unsignedBigInteger('payment_option_id')->after('listing_id');

        // Add foreign key constraint if desired
        $table->foreign('payment_option_id')->references('id')->on('payment_options')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign(['payment_option_id']);
        $table->dropColumn('payment_option_id');
    });
}

};
