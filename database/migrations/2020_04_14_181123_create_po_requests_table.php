<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ppp_request_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            // $table->nullableMorphs('distmanagerable');
            // $table->nullableMorphs('managereable');
            // $table->nullableMorphs('super_adminable');
            $table->string('number')->nullable();
            $table->string('name');
            $table->date('po_date')->nullable();
            $table->decimal('request_amount', 9, 2)->default(0);
            $table->string('transaction_currency')->nullable();
            $table->string('transaction_group')->nullable();
            $table->string('supplier')->nullable();
            $table->string('country')->nullable();
            $table->string('exchange_rate')->nullable();
            $table->string('program_title')->nullable();
            $table->string('purpose')->nullable();
            $table->text('description')->nullable();
            $table->text('objective')->nullable();
            $table->text('scheme')->nullable();
            $table->text('mechanics')->nullable();
            $table->text('additional_notes')->nullable();
            $table->text('additional_instruction')->nullable();
            $table->dateTime('manager_approved_at')->nullable();
            $table->dateTime('district_manager_approved_at')->nullable();
            $table->dateTime('super_admin_approved_at')->nullable();
            $table->dateTime('denied_at')->nullable();
            $table->dateTime('resubmitted_at')->nullable();
            $table->integer('approval_status')->default(0); // 0 - district manager approval, 1 - manager approval, 2 - super admin approval
            $table->integer('status')->default(1); // 1 - pending, 2 - approved, 3 - denied, 4 - resubmitted
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
        Schema::dropIfExists('po_requests');
    }
}
