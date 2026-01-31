<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First add the new enum values to the column
        DB::statement("ALTER TABLE ledger_masters MODIFY COLUMN balance_type ENUM('Debit', 'Credit', 'Bill by Bill', 'On Account') DEFAULT 'Bill by Bill'");

        // Then update existing records to valid values
        DB::statement("UPDATE ledger_masters SET balance_type = 'Bill by Bill' WHERE balance_type = 'Debit'");
        DB::statement("UPDATE ledger_masters SET balance_type = 'On Account' WHERE balance_type = 'Credit'");

        // Finally, remove the old enum values
        DB::statement("ALTER TABLE ledger_masters MODIFY COLUMN balance_type ENUM('Bill by Bill', 'On Account') DEFAULT 'Bill by Bill'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum
        DB::statement("ALTER TABLE ledger_masters MODIFY COLUMN balance_type ENUM('Debit', 'Credit') DEFAULT 'Debit'");
    }
};
