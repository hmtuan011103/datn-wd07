<?php

namespace App\Http\Controllers\Ticket\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ticket\BaseTicketController;
use App\Models\Ticket;
use Dompdf\Dompdf;
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

    public function export($codes){
        $codeArray = explode(',', $codes);
        $tickets = Ticket::whereIn('code_ticket',$codeArray)->with('bill.trip.route')->get();
        foreach ($tickets as $key => $value) {
            $dateTime = $value->bill->trip->start_date;
            $time = $value->bill->trip->start_time;
            $dateFormatted = date("d/m/Y", strtotime($dateTime));
            $timeFormatted = date("H:i:s", strtotime($time));
            $dateTimeFormatted = $timeFormatted . " " . $dateFormatted;
            $tickets[$key]['time_start'] = $dateTimeFormatted;
            $ticket_ud = Ticket::find($value->id);
            if ($value->status != 1) {
                unset($tickets[$key]);
            }
            if ($ticket_ud->status == 1) {
                $ticket_ud->status = 0;
                $ticket_ud->save();
            }
        }
        if(count($tickets) == 0) {
            toastr('error', "Vé đã được checkin");
            return redirect()->back();
        }
        $number_ticket = count($tickets);
        $length = $number_ticket*490;
        $dompdf = new Dompdf();
        // return view('admin.pages.search-bill.pdf',compact('tickets'));
        $html = view('admin.pages.search-bill.pdf', compact('tickets','number_ticket'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 300, $length]);
        $dompdf->render();
        $dompdf->stream('vexe.pdf');
    }
}
