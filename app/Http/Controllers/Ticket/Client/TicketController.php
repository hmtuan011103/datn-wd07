<?php

namespace App\Http\Controllers\Ticket\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ticket\BaseTicketController;
use Illuminate\Http\Request;

class TicketController extends BaseTicketController
{
    //

    public function search_ticket(Request $request)
    {
        $ticket = $this->ticketService->search_bill($request);
        return response()->json($ticket);   
     }
}
