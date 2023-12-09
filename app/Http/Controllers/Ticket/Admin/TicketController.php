<?php

namespace App\Http\Controllers\Ticket\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ticket\BaseTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends BaseTicketController
{
    public function form_search_bill() {
        return view('admin.pages.search-bill.main', [
            'title' => 'TRA CỨU THÔNG TIN ĐẶT VÉ',
        ]);
    }
    public function search_bill_admin(Request $request)
    {
        $bill_admin = $this->ticketService->search_bill($request);
        return response()->json($bill_admin);
    }

    public function testMail() {
        $name = "Bạn đã mua vé thành công rồi Tuấn";
        Mail::send('client.pages.email.test', compact('name'), function ($email) {
            $email->subject('Test Mail Chiến Thắng Bus');
            $email->to('tuanhmph28448@fpt.edu.vn');
        });
    }

    // search bill

    public function form_search_ticket() {
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
