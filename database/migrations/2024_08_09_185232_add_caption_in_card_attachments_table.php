<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('card_attachments', function (Blueprint $table) {
            $table->string('caption')->nullable();
        });
    }

    public function down(): void
    {
        //
    }
};
