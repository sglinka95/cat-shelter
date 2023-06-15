<?php

use App\Enums\BreedEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\SexEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('name', 255);
            $table->enum('sex', SexEnum::values());
            $table->date('birthdate')->nullable();
            $table->uuid('department_id')->index()->nullable();
            $table->uuid('employee_id')->index()->nullable();
            $table->enum('breed', BreedEnum::values())->nullable();
            $table->string('description')->nullable();
            $table->boolean('sterilized')->default(false);
            $table->timestamps();

            $table
                ->foreign('department_id')
                ->references('id')
                ->on('departments');

            $table
                ->foreign('employee_id')
                ->references('id')
                ->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('cats');
    }
};
