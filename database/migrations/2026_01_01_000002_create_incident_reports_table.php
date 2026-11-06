<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique();
            $table->string('reporter_name');
            $table->string('reporter_email')->nullable();
            $table->string('reporter_phone');
            $table->string('reporter_nationality')->default('Indonesia');
            $table->string('passport_or_id')->nullable();
            $table->string('category'); // theft, scam, traffic_accident, medical, lost_document, harassment, other
            $table->string('regency'); // Badung, Denpasar, Gianyar, Tabanan, Buleleng, Karangasem, Bangli, Klungkung, Jembrana
            $table->string('incident_location');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->dateTime('incident_date');
            $table->text('description');
            $table->string('attachment_path')->nullable();
            $table->string('status')->default('SUBMITTED'); // SUBMITTED, UNDER_INVESTIGATION, IN_ACTION, RESOLVED, REJECTED
            $table->string('priority')->default('MEDIUM'); // LOW, MEDIUM, HIGH, CRITICAL
            $table->text('officer_notes')->nullable();
            $table->string('assigned_agency')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incident_reports');
    }
};
