<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ingredient_category_id')->nullable()->constrained();
            $table->foreignId('unit_id')->constrained();

            $table->string('name');
            $table->longText('notes')->nullable();

            $table->unsignedBigInteger('price_per_pack')->default(0);
            $table->unsignedBigInteger('unit_per_pack')->default(0);

            $table->bigInteger('stock_packs')->default(0);
            $table->bigInteger('stock_units')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
};
