<?php

namespace App\Http\Controllers\Ticket\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ticket\BaseTicketController;
use Illuminate\Http\Request;

class TicketController extends BaseTicketController
{
    public function form_search() {
        return view('admin.pages.search-ticket.main', [
            'title' => 'TRA CỨU THÔNG TIN ĐẶT VÉ',
        ]);
    }
    public function search_ticket_admin(Request $request)
    {
        $ticket_admin = $this->ticketService->search_ticket($request);
        return response()->json($ticket_admin);   
     }
}
