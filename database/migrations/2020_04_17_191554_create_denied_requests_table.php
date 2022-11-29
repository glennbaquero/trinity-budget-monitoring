<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeniedRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denied_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('deniedable');
            $table->nullableMorphs('requestable');
            $table->dateTime('denied_at')->nullable();
            $table->dateTime('resubmitted_at')->nullable();
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('denied_requests');
    }
}
