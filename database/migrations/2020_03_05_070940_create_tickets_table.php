<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject')->nullable();
            $table->string('source');
            $table->string('priority');
            $table->integer('status');
            $table->string('program');
            $table->integer('contact_id');
            $table->integer('agent_id');
            $table->integer('level_id')->nullable();
            $table->string('description');
            $table->string('attachments')->nullable();
            $table->bigInteger('ticket_number');
            $table->string('other_programs')->nullable();
            $table->string('other_sources')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('update_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
