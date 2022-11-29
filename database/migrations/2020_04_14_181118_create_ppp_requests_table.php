<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePppRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppp_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('budget_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->integer('manager_id')->unsigned()->index();
            // $table->nullableMorphs('finance');
            // $table->nullableMorphs('super_admin');
            $table->string('number')->nullable();
            $table->string('name');
            $table->decimal('requested_amount', 9, 2)->default(0);
            $table->decimal('current_balance', 9, 2)->default(0);
            $table->decimal('total_balance', 9, 2)->default(0);
            $table->string('line_business')->nullable();
            $table->text('description')->nullable();
            $table->date('period_start_at');
            $table->date('period_end_at');
            $table->dateTime('finance_approved_at')->nullable();
            $table->dateTime('super_admin_approved_at')->nullable();
            $table->dateTime('denied_at')->nullable();
            $table->dateTime('resubmitted_at')->nullable();
            $table->integer('approval_status')->default(0); // 0 - finance approval, 1 - super admin approval, 2 - Done
            $table->integer('status')->default(1); // 1 - Pending, 2 - Approved, 3 - Denied, 4 - Resubmitted
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
        Schema::dropIfExists('ppp_requests');
    }
}
