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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->boolean('is_active')->default(true)->index();

            $table->string('sequence_group')->index();
            $table->unsignedInteger('sequence')->index();
            $table->string('member_id')->index();

            $table->string('name');

            $table->string('email')->unique()->index()->nullable();;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();

            $table->string('phone')->unique()->index()->nullable();
            $table->date('date_of_birth')->nullable();

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
        Schema::dropIfExists('customers');
    }
};
