<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_account_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idCurrentAccount')->unsigned();            
            $table->foreign('idCurrentAccount')->references('id')->on('current_accounts');
            $table->bigInteger('idClient')->unsigned();            
            // $table->foreign('idClient')->references('id')->on('clients');           
            $table->bigInteger('idsale')->unsigned();            
            // $table->foreign('idsale')->references('id')->on('sales');
            $table->date('date');
            $table->integer('typemovement');
            $table->decimal('pay', 8, 2);
            $table->decimal('sale', 8, 2);
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
        Schema::dropIfExists('current_account_details');
    }
}
