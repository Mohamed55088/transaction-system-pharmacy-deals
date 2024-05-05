<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('has_money', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->foreignId('type_medicine_id')->nullable()->constrained()->onDelete("cascade");
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete("cascade");
            $table->foreignId('user_id')->nullable()->constrained()->onDelete("cascade");
            $table->integer('month');
            $table->softDeletes();
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
        Schema::dropIfExists('has_money');
    }
}
