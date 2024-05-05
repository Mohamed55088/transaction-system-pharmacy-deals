<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateSalesCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_sales_customers', function (Blueprint $table) {
            $table->id();
            $table->longText('value_update');
            $table->foreignId('sale_id')->nullable()->constrained('sales', 'id')->onDelete('cascade');
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
        Schema::dropIfExists('update_sales_customers');
    }
}
