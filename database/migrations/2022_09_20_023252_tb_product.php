<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    protected $table_name = 'product';

    public function up()
    {
        
        Schema::create($this->table_name, function(Blueprint $table) {

            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->string('price');
            $table->string('stock_qty');
            $table->string('image_url')->nullable();
            $table->timestamps();

            // foreign key
            // $table->foreign('category_id')->references('id')->on('category');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
