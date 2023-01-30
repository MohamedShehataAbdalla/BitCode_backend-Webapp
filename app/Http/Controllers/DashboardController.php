<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Invoice;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // $count_invoices_all = Invoice::count();
        // $count_invoices_paid = Invoice::where('payment_status','paid')->count();
        // $count_invoices_unpaid = Invoice::where('payment_status','unpaid')->count();
        // $count_invoices_partial = Invoice::where('payment_status','partial')->count();

        // $sum_invoices_all = Invoice::sum('total_due');
        // $sum_invoices_paid = Invoice::where('payment_status','paid')->sum('total_due');
        // $sum_invoices_unpaid = Invoice::where('payment_status','unpaid')->sum('total_due');
        // $sum_invoices_partial = Invoice::where('payment_status','partial')->sum('total_due');

        // if($count_invoices_paid == 0){
        //     $count_nspa_invoices_paid = 0;
        // }else {
        //     $count_nspa_invoices_paid = ($count_invoices_paid / $count_invoices_all) * 100;
        // }

        // if($count_invoices_unpaid == 0){
        //     $count_nspa_invoices_unpaid = 0;
        // }else {
        //     $count_nspa_invoices_unpaid = ($count_invoices_unpaid / $count_invoices_all) * 100;
        // }

        // if($count_invoices_partial == 0){
        //     $count_nspa_invoices_partial = 0;
        // }else {
        //     $count_nspa_invoices_partial = ($count_invoices_partial / $count_invoices_all) * 100;
        // }

        // if($sum_invoices_paid == 0){
        //     $sum_nspa_invoices_paid = 0;
        // }else {
        //     $sum_nspa_invoices_paid = ($sum_invoices_paid / $sum_invoices_all) * 100;
        // }

        // if($sum_invoices_unpaid == 0){
        //     $sum_nspa_invoices_unpaid = 0;
        // }else {
        //     $sum_nspa_invoices_unpaid = ($sum_invoices_unpaid / $sum_invoices_all) * 100;
        // }

        // if($sum_invoices_partial == 0){
        //     $sum_nspa_invoices_partial = 0;
        // }else {
        //     $sum_nspa_invoices_partial = ($sum_invoices_partial / $sum_invoices_all) * 100;
        // }


        // $chartjs = app()->chartjs
        //  ->name('barChartTest')
        //  ->type('bar')
        //  ->size(['width' => 400, 'height' => 200])
        //  ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
        //  ->datasets([
        //      [
        //          "label" => "الفواتير الغير المدفوعة",
        //          'backgroundColor' => ['rgba(255, 99, 132, 0.2)'],
        //          'data' => [$sum_nspa_invoices_unpaid]
        //      ],
        //      [
        //         "label" => "الفواتير المدفوعة",
        //         'backgroundColor' => [ 'rgba(54, 162, 235, 0.2)'],
        //         'data' => [$sum_nspa_invoices_paid]
        //     ],
        //      [
        //          "label" => "الفواتير المدفوعة جزئيا",
        //          'backgroundColor' => ['rgba(255, 242, 224, 1)'],
        //          'data' => [$sum_nspa_invoices_partial]
        //      ]
        //  ])
        //  ->options([]);


        //  $chartjs_2 = app()->chartjs
        //     ->name('pieChartTest')
        //     ->type('pie')
        //     ->size(['width' => 340, 'height' => 200])
        //     ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
        //     ->datasets([
        //         [
        //             'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
        //             'data' => [$count_nspa_invoices_unpaid, $count_nspa_invoices_paid,$count_nspa_invoices_partial]
        //         ]
        //     ])
        //     ->options([]);

        // return view('pages.dashboard', compact('chartjs','chartjs_2'));

        
        return view('pages.dashboard');

    }
}
