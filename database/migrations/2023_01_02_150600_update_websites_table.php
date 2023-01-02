<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->foreignUuid('brand_id')->after('id')->constrained('brands');
        });
    }

    public function down()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->dropForeign('websites_brand_id_foreign');
            $table->dropColumn('brand_id');
        });
    }
};
