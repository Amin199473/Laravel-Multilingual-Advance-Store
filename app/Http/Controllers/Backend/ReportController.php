<?php

namespace App\Http\Controllers\Backend;

use DateTime;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function ReportView()
    {
        return view('backend.report.view');
    }


    public function ReportByDate(Request $request)
    {
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        $orders = Order::where('order_date', $formatDate)->latest()->get();

        return view('backend.report.reportByDate', compact('orders'));
    }

    public function ReportByMonth(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $orders = Order::where('order_month', $month)->where('order_year', $year)->latest()->get();

        return view('backend.report.reportByDate', compact('orders'));
    }

    public function ReportByYear(Request $request)
    {
        $year = $request->year;
        $orders = Order::where('order_year', $year)->latest()->get();

        return view('backend.report.reportByDate', compact('orders'));
    }
}
