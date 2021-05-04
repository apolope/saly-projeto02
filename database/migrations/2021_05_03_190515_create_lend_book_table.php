<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lend_book', function (Blueprint $table) {
            $table->id();
            $table->string('comments')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('lend_id');
            $table->unsignedBigInteger('book_id');
            $table->foreign('lend_id')->references('id')->on('lends')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lend_book');
    }
}
