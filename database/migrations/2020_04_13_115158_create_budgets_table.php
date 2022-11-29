<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->dateTime('period_start_at');
            $table->dateTime('period_end_at');
            $table->decimal('budget_amount', 9, 2)->default(0);
            $table->longText('description')->nullable();

            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.;
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets');
    }
}
