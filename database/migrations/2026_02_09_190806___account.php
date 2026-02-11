<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('accounts', function (Blueprint $table) {
            $table->id('id_account');
            $table->string('nama_account', 50);
            $table->enum('jenis', ['cash', 'bank', 'ewallet']);
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();

            $table->decimal('saldo', 15, 2)->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('transactions')) {
            Schema::table('transactions', function (Blueprint $table) {
                if (Schema::hasColumn('transactions', 'id_account')) {
                    $table->dropForeign(['id_account']);
                }
            });
        }

        Schema::dropIfExists('accounts');
    }
};
