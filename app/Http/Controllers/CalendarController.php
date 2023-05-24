<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{
   public function index()
   { 
     $events = array();
    $bookings = Booking::all();
    foreach($bookings as $booking) {
   
        $events[] = [
            'id'=> $booking->ID,
            'title' => $booking->title,
            'start' => $booking->start_date,
            'end' => $booking->end_date
        ];
    }
    return view('calendar.index', ['events' => $events]);
   }
   public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);
        $booking = Booking::create([
            
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return $booking;
    }
    public function update(Request $request, $id)
    {
        $booking = DB::table('bookings')->find($id);

    if (! $booking) {
        return response()->json([
            'error' => 'Unable to locate the event'
        ], 404);
    }

    DB::table('bookings')
        ->where('ID', $id)
        ->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json('Event updated successfully');
        
    }
    public function destroy(Request $request, $id)
    {
        $booking = DB::table('bookings')->find($id);

        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        
        DB::table('bookings')->where('ID', $id)->delete();

        return response()->json('Event deleted successfully');

    }

}
