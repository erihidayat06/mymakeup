<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tokos', function (Blueprint $table) {
            $table->enum('domisili', ['Kota Tegal', 'Kab Tegal'])->default(null);
            $table->enum('kecamatan', [
                'margasari', 'bumijawa', 'bojong', 'balapulang', 'pagerbarang',
                'lebaksiu', 'jatinegara', 'kedungbanteng', 'pangkah', 'slawi', 'dukuhwaru', 'adiwerna',
                'dukuhturi', 'talang', 'tarub', 'kramat', 'suradadi', 'warureja', 'margadana',
                'tegal barat', 'tegal selatan', 'tegal timur'
            ])->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tokos', function (Blueprint $table) {
            $table->dropColumn('domisili');
            $table->dropColumn('kecamatan');
        });
    }
};
