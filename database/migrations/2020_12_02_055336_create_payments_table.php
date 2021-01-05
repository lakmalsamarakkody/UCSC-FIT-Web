<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->tinyInteger('method_id');
            $table->tinyInteger('type_id');            
            $table->decimal('amount',10,2);
            $table->string('bank')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('branch_code')->nullable();
            $table->date('paid_date');
            $table->string('image')->nullable();
            $table->string('status')->length(25)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
