<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('committee_id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('company_id');
            $table->timestamp('date')->useCurrent();
            $table->integer('quantity');
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('committee_id')
                ->references('id')->on('committees')->onDelete('cascade');
            $table->foreign('member_id')
                ->references('id')->on('members')->onDelete('cascade');
            $table->foreign('company_id')
                ->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
