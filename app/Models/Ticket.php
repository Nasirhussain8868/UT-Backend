<?php			
			
namespace App\Models;			
			
use Illuminate\Database\Eloquent\Factories\HasFactory;			
use Illuminate\Database\Eloquent\Model;			
			
class Ticket extends Model			
{			
    use HasFactory;			
    protected $fillable = [			
        'location_category',			
        'unique_id',	
        'start_location',			
        'sl_in_bmw',		
        'possible_issue',			
        'liveLayer_or_expected_sl',			
        'direction',			
        'end_location',			
        'comments',			
        'fc',			
        'time',			
        'country',			
        'road_type',			
        'reality',			
        'map',			
        'current_map_sl',			
        'assignee',			
        'main_comments_scl20_fm8628_v89',			
        'error_category',			
        'do_comments_observation',			
        'topology_id',			
        'logical_sign_id',			
        'observed_speedlimit',			
        'expected_speedlimit',			
        'dO_comment_expected',			
        'error_description',			
        'scl20_cat',		
        'scl20_err_cat',			
        'scl20_sub_cat',			
        'isAvtive',
        'user_id',
        'isComplete',	
    ];			
}			
