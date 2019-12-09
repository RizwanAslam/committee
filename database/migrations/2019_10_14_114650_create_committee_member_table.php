<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteeMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('committee_id');
            $table->unsignedBigInteger('member_id');
            $table->integer('quantity');
            $table->integer('amount')->nullable();
            $table->string('status')->default('unpaid');
            $table->timestamp('withdraw_date')->nullable();
            $table->timestamp('withdraw_month')->nullable();
            $table->integer('withdraw_order')->nullable();
            $table->timestamp('monthly_withdraw_date')->nullable();
            $table->boolean('withdraw')->default(0);
            $table->timestamps();
            $table->foreign('committee_id')
                ->references('id')->on('committees')
                ->onDelete('cascade');
            $table->foreign('member_id')
                ->references('id')->on('members')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committee_member');
    }
}
