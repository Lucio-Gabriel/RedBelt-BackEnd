<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alarms', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('criticality')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->boolean('active')->default(1);
            $table->timestamp('date_occurred')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedTinyInteger('deleted_by')->nullable();
            $table->unsignedBigInteger( 'alarms_types_id')->nullable();
            $table->foreign('alarms_types_id')->references('id')->on('alarms_types')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alarms');
    }
};
