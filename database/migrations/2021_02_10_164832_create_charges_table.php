<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->enum('method', ['fixed', 'percent'])->default('percent');
            $table->enum('target', ['quantity', 'price', 'subtotal', 'grandtotal']);
            $table->decimal('value', 12, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('chargeables', function (Blueprint $table) {
            $table->foreignId('charge_id')->references('id')->on('charges');
            $table->morphs('chargeable');
            $table->decimal('value', 12, 2);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('chargeables');
        Schema::dropIfExists('charges');
    }
}
