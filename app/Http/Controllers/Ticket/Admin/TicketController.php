<?php

namespace App\Http\Controllers\Ticket\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ticket\BaseTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends BaseTicketController
{
    public function form_search() {
        return view('admin.pages.search-ticket.main', [
            'title' => 'TRA CỨU THÔNG TIN ĐẶT VÉ',
        ]);
    }
    public function search_ticket_admin(Request $request)
    {
        $ticket = $this->ticketService->search_ticket($request);
        return response()->json($ticket);
    }

    public function testMail() {
        $name = "Bạn đã mua vé thành công rồi Tuấn";
        Mail::send('client.pages.email.test', compact('name'), function ($email) {
            $email->subject('Test Mail Chiến Thắng Bus');
            $email->to('tuanhmph28448@fpt.edu.vn');
        });
    }
}
