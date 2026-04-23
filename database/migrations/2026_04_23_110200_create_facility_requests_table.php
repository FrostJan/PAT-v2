<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facility_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('activity_purpose_id')->constrained()->restrictOnDelete();
            $table->string('department');
            $table->string('division');
            $table->unsignedInteger('attendees');
            $table->date('date_filed');
            $table->date('date_needed');
            $table->time('time_needed_start');
            $table->time('time_needed_end');
            $table->string('person_in_charge');
            $table->string('contact_number');
            $table->json('services');
            $table->json('classification');
            $table->string('attachment_path')->nullable();
            $table->string('attachment_original_name')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('decided_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('decided_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('status');
            $table->index('date_needed');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_requests');
    }
};
