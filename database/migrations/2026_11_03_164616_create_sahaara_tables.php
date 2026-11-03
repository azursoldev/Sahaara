<?php

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
        // 1. Cities
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('province')->default('Punjab');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Service Categories
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->default('bi-heart-pulse');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 3. Services / Packages
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('service_categories')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('estimated_cost', 10, 2)->default(0.00); // 0 = Free / Welfare
            $table->string('provider_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });

        // 4. Graveyards Directory
        Schema::create('graveyards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->string('name');
            $table->string('address');
            $table->string('sector_or_area')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('has_space')->default(true);
            $table->text('map_url')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 5. Service Requests (Emergency SOS / Booking)
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->string('deceased_name')->nullable();
            $table->enum('deceased_gender', ['male', 'female', 'child', 'unspecified'])->default('unspecified');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('contact_relation')->nullable();
            $table->text('pickup_address');
            $table->text('destination_address')->nullable();
            $table->json('services_needed')->nullable(); // e.g. ['ambulance', 'ghusl', 'kafan', 'qabar']
            $table->boolean('is_mustahiq')->default(false); // Free Welfare aid
            $table->string('status')->default('pending'); // pending, assigned, in_progress, completed, cancelled
            $table->text('notes')->nullable();
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
        });

        // 6. Janazah Announcements (Digital Card & Notice Board)
        Schema::create('janazah_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('unique_code')->unique();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->string('deceased_name');
            $table->string('relation_title')->nullable(); // e.g. Walid-e-Mohtaram, Walida, Bhai, etc.
            $table->string('family_member_name');
            $table->string('contact_phone');
            $table->date('janazah_date');
            $table->string('janazah_prayer_time'); // e.g. "Baad Namaz-e-Asr (5:15 PM)"
            $table->string('mosque_or_place');
            $table->string('graveyard_name')->nullable();
            $table->text('additional_details')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });

        // 7. Volunteers / Field Providers
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->string('service_type'); // ghassal_male, ghassal_female, driver, gor_kan, volunteer
            $table->string('area')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
        Schema::dropIfExists('janazah_announcements');
        Schema::dropIfExists('service_requests');
        Schema::dropIfExists('graveyards');
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_categories');
        Schema::dropIfExists('cities');
    }
};
