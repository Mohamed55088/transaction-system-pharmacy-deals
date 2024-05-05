<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateValueCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_value_customers', function (Blueprint $table) {
            $table->id();
            $table->longText('value_update');
            $table->foreignId('has_money_id')->nullable()->constrained('has_money', 'id')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete("cascade");
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
        Schema::dropIfExists('update_value_customers');
    }
}
