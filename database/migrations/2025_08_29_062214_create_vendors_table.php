<?php

use App\Models\Vendor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: Vendor::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name');
            $table->string(column: 'email')->unique()->nullable();
            $table->string(column: 'phone')->nullable();
            $table->string(column: 'address')->nullable();
            $table->string(column: 'website')->nullable();
            $table->string(column: 'contact_person_name')->nullable();
            $table->string(column: 'contact_person_email')->nullable();
            $table->string(column: 'contact_person_phone')->nullable();
            $table->boolean(column: 'is_active')->default(value: true);
            $table->timestamps();
        });
    }
};
