<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateBooksTable extends Migration
{

    public function up(){
        Schema::create('books', function(Blueprint $table)
        {
            $table -> incerements('id');
            $table -> string('name');
            $table -> text('author');
            $table -> timestamps();
        }
        );
    }
}
