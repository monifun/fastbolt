<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->string('currency_code', 3);
            $table->decimal('currency_rate', 12, 2);
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone', 15)->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('status')->default(\App\Enums\OrderStatus::PENDING);
            $table->boolean('is_draft')->default(true);
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
        Schema::dropIfExists('orders');
    }
}
