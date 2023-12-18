<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemesTable extends Migration
{
    public function up()
    {
        Schema::create('schemes', function (Blueprint $table) {
            $table->id();
            $table->string('loan_name');
            $table->decimal('interest_percentage', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schemes');
    }
}
