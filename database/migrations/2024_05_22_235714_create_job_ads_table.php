<?php

use App\Enums\EmploymentTypes;
use App\Enums\Schedules;
use App\Enums\Seniorities;
use App\Enums\YearsOfExperience;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_ads', function (Blueprint $table) {
            $table->id();
            $table->string('external_ref')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignId('department_id')->constrained();
            $table->string('slug');
            $table->string('title');
            $table->string('subcompany');
            $table->string('occupation');
            $table->enum('employment_type', EmploymentTypes::values());
            $table->enum('seniority', Seniorities::values());
            $table->enum('schedule', Schedules::values());
            $table->enum('years_of_experience', YearsOfExperience::values());
            $table->dateTime('published_at')->nullable();
            $table->dateTime('marked_as_spam_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_ads');
    }
};
