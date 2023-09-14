<?php			
			
namespace App\Http\Controllers;			
			
use App\Models\Ticket;			
use Illuminate\Http\Request;			
			
class TicketController extends Controller			
{			
    public function ticketView()			
    {
        $loggeduser = auth()->user();
        if($loggeduser->role === 'admin'){
            $ticket = Ticket::all();
        }
        else{
            $ticket = Ticket::where('user_id', $loggeduser->id)->get();
        }
    			
        return response()->json(['user' => $loggeduser ,'data' => $ticket,	 'status' => 'success',	 'message' => 'Data get successfully'],	 200);
    }			
    public function deleteAll(Request $request)			
    {			
        try {			
            Ticket::truncate(); // Delete all records from the table			
			
            return response()->json(['message' => 'All records deleted successfully.']);			
        } catch (\Exception $e) {			
            return response()->json(['error' => 'An error occurred while deleting records.'],	 500);		
        }			
    }			
   			
			
			
    public function uploadCsv(Request $request)			
    {			
        $file = $request->file('csv_file');			
        $file_path = $file->getPathname();			
			
        try {			
            $csv_data = array_map('str_getcsv',	 file($file_path));		
			
            foreach ($csv_data as $row) {			
                Ticket::create([			
                    'location_category' => empty($row[0]) ? '' : $row[0],			
                    'unique_id' => empty($row[1]) ? '' : $row[1],			
                    'start_location' => empty($row[2]) ? '' : $row[2],			
                    'sl_in_bmw' => empty($row[3]) ? '' : $row[3],			
                    'possible_issue' => empty($row[4]) ? '' : $row[4],			
                    'liveLayer_or_expected_sl' => empty($row[5]) ? '' : $row[5],		
                    'direction' => empty($row[6]) ? '' : $row[6],			
                    'end_location' => empty($row[7]) ? '' : $row[7],			
                    'comments' => empty($row[8]) ? '' : $row[8],		
                    'fc' => empty($row[9]) ? '' : $row[9],				
                    'time' => empty($row[10]) ? '' : $row[10],			
                    'country' => empty($row[11]) ? '' : $row[11],			
                    'road_type' => empty($row[12]) ? '' : $row[12],			
                    'reality' => empty($row[13]) ? '' : $row[13],			
                    'map' => empty($row[14]) ? '' : $row[14],			
                    'current_map_sl' => empty($row[15]) ? '' : $row[15],		
                    'assignee' => empty($row[16]) ? '' : $row[16],			
                    'main_comments_scl20_fm8628_v89' => empty($row[17]) ? '' : $row[17],			
                    'error_category' => empty($row[18]) ? '' : $row[18],		
                    'do_comments_observation' => empty($row[19]) ? '' : $row[19],			
                    'topology_id' => empty($row[20]) ? '' : $row[20],			
                    'logical_sign_id' => empty($row[21]) ? '' : $row[21],			
                    'observed_speedlimit' => empty($row[22]) ? '' : $row[22],
                    'expected_speedlimit' => empty($row[23]) ? '' : $row[23],			
                    'dO_comment_expected' => empty($row[24]) ? '' : $row[24],			
                    'scl20_cat' => empty($row[26]) ? '' : $row[26],				
                    'error_description' => empty($row[25]) ? '' : $row[25],		
                    'scl20_err_cat' => empty($row[27]) ? '' : $row[27],			
                    'scl20_sub_cat' => empty($row[28]) ? '' : $row[28],			
                ]);			
            }			
			
            return response()->json(['message' => 'CSV file uploaded and data inserted.']);			
        } catch (\Exception $e) {			
            return response()->json(['error' => $e],	 500);		
        }			
    }			
			
    public function updateMainComments(Request $request)		
    {			
        $loggeduser = auth()->user();

            try {
                $validatedData = $request->validate([
                    'main_comments_scl20_fm8628_v89' => 'required',
                    'error_category' => 'required',
                    'do_comments_observation' => 'required',
                    'topology_id' => 'required',
                    'logical_sign_id' => 'required',
                    'observed_speedlimit' => 'required',
                    'expected_speedlimit' => 'required',
                    'dO_comment_expected' => 'required',
                    'error_description' => 'required',
                ]);
                $validatedData['assignee'] = $loggeduser->name; 
                $validatedData['isComplete'] = true;    
                $ticket = Ticket::findOrFail($request->id);
    
                // Retrieve the previous images URLs from the database and decode them from JSON to an array
              
    
                $ticket->update($validatedData);
    
                return response()->json(['status' => 'success', 'message' => 'Data updated successfully'], 200);
            } catch (\Illuminate\Validation\ValidationException $exception) {
                // Validation failed
                $errors = $exception->errors();
                return response()->json(['status' => 'failed', 'errors' => $errors, 'message' => 'Validation failed'], 200);
            } catch (\Throwable $th) {
                // Other exceptions occurred
                return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 200);
            }
    }		
    public function getAllTicket()
    {
        $tickets = Ticket::where('isAvtive', true)->get();
        return response()->json(['ticket' => $tickets], 200);
    }	

    public function updateTicketsUserId(Request $request)
    {
       try {
        $userId = $request->input('userSelectedid');
       $ticketIds = $request->input('TicketsIds');

      // Update user_id in the tickets table
      Ticket::whereIn('unique_id', $ticketIds)->update(['user_id' => $userId, 'isAvtive' => false]);

      return response()->json(['status' => 'success', 'message' => 'Data updated successfully'], 200);
       } catch (\Throwable $th) {
        return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 200);
       }
    }


    public function Reassign(Request $request){
        try {
            $userId = $request->input('id');
    
          // Update user_id in the tickets table
          Ticket::where('unique_id', $userId)->update(['isComplete' => false]);
    
          return response()->json(['data' => $userId ,'status' => 'success', 'message' => 'unique id ' .$userId.' Reassign Successfully'], 200);
           } catch (\Throwable $th) {
            return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 200);
           }
    }
}			
