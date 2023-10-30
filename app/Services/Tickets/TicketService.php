<?php
    namespace App\Services\Tickets;

use Illuminate\Support\Facades\DB;

    class TicketService {
        public function search_ticket($request) {
          
                $ticketList = DB::table('ticket_order')
                    ->join('bills', 'ticket_order.bill_id', '=', 'bills.id')
                    ->join('users', 'bills.user_id', '=', 'users.id')
                    ->join('trips', 'bills.trip_id', '=', 'trips.id')
                    ->join('seats', 'ticket_order.code_seat', '=', 'seats.id')
                    ->where('users.phone_number', $request->phone_number)
                    ->where('bills.code_bill', $request->code_bill)
                    ->select('ticket_order.*', 'users.*', 'trips.*','seats.*','bills.*')
                    ->get();
                

            return $ticketList;
        }
    }
?>