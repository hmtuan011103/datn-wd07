<?php
    namespace App\Services\Tickets;

use App\Models\Bill;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

    class TicketService {
        public function search_bill($request) {

            // dd($request->ticketCode);
          
            $ticketList = Ticket::join('bills', 'ticket_order.bill_id', '=', 'bills.id')
                ->join('users', 'bills.user_id', '=', 'users.id')
                ->join('trips', 'bills.trip_id', '=', 'trips.id')
                ->where('bills.user_phone', $request->phone_number)
                ->where('bills.code_bill', $request->code_bill)
                ->with('bill.trip.car')
                ->select('ticket_order.*', 'users.*', 'trips.*','bills.*','ticket_order.status AS ticket_status')
                ->get();
            
            return $ticketList;

        
        }

        public function search_ticket($request) {
          

                $ticketList = Ticket::join('bills', 'ticket_order.bill_id', '=', 'bills.id')
                ->join('users', 'bills.user_id', '=', 'users.id')
                ->join('trips', 'bills.trip_id', '=', 'trips.id')
                ->where('bills.user_phone', $request->phone_number)
                ->where('ticket_order.code_ticket', $request->code_ticket)
                ->with('bill.trip.car')
                ->select('ticket_order.*', 'users.*', 'trips.*','bills.*','ticket_order.status AS ticket_status')
                ->get();
            
            return $ticketList;
        }

        
    }
?>