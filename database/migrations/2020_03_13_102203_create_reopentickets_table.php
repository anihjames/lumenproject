<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReopenticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reopentickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ticket_number');
            $table->tinyInteger('status')->default(1);
            $table->string('prev_solution');
            $table->string('new_solution')->nullable();
            $table->boolean('is_escalated')->default(false);
            $table->tinyInteger('agent')->nullable();
            $table->tinyInteger('level')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reopentickets');
    }
}
