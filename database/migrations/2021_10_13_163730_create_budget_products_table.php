<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('budgetId')->unsigned();            
            $table->foreign('budgetId')->references('id')->on('budgets');
            $table->string('name');
            $table->integer('cantProduct');
            $table->decimal('priceProduct', 8, 2);
            $table->decimal('subtotal', 8, 2);   
            $table->Softdeletes();   
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
        Schema::dropIfExists('budget_products');
    }
}
