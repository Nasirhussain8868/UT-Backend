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
        Schema::create('tickets',	function (Blueprint $table) {		
            $table->id();			
            $table->string('location_category')->nullable();			
            $table->string('unique_id')->nullable();			
            $table->string('start_location')->nullable();			
            $table->string('sl_in_bmw')->nullable();			
            $table->string('possible_issue')->nullable();			
            $table->string('liveLayer_or_expected_sl')->nullable();			
            $table->string('direction')->nullable();			
            $table->string('end_location')->nullable();			
            $table->string('comments')->nullable();			
            $table->string('fc')->nullable();			
            $table->string('time')->nullable();			
            $table->string('country')->nullable();			
            $table->string('road_type')->nullable();			
            $table->string('reality')->nullable();			
            $table->string('map')->nullable();			
            $table->string('current_map_sl')->nullable();			
            $table->string('assignee')->nullable();			
            $table->string('main_comments_scl20_fm8628_v89')->nullable();			
            $table->string('error_category')->nullable();			
            $table->string('do_comments_observation')->nullable();			
            $table->string('topology_id')->nullable();			
            $table->string('logical_sign_id')->nullable();			
            $table->string('observed_speedlimit')->nullable();			
            $table->string('expected_speedlimit')->nullable();			
            $table->string('dO_comment_expected')->nullable();			
            $table->string('error_description')->nullable();			
            $table->string('scl20_cat')->nullable();			
            $table->string('scl20_err_cat')->nullable();			
            $table->string('scl20_sub_cat')->nullable();			
            $table->timestamps();			
            $table->boolean(('isAvtive'))->default(true);			
        });			
    }			
			
    /**			
     * Reverse the migrations.			
     *			
     * @return void			
     */			
    public function down()			
    {			
        Schema::dropIfExists('tickets');			
    }			
};			
