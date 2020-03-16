<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->float('price');
            $table->unsignedInteger('quantity');
            $table->tinyInteger('in_stock')->default(BOOK_IN_STOCK);
            $table->integer('total_pages');
            $table->string('isbn_number')->unique();
            $table->string('language');
            $table->string('characters')->nullable();
            $table->string('series_name')->nullable();
            $table->text('description');
            $table->date('published_on');
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
        Schema::dropIfExists('book_infos');
    }
}
