<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tender;
use App\Models\TenderInvitation;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Users',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\User',
            'group_by_field'        => 'email_verified_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'           => 'Bidder',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\BidderManager',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        $chart2 = new LaravelChart($settings2);
        $user = Auth::user();
        $inviteTenders = TenderInvitation::select("tender_id","user_id")->with('tender')->where('tender_invitations.user_id', '=', $user->id)->groupBy("tender_id","user_id")->get();
//        echo "<pre>";print_r($inviteTenders->toArray());exit();
        return view('home', compact('chart1', 'chart2','inviteTenders'));
    }
}
