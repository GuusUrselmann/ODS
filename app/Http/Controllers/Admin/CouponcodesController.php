<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponcodesController extends Controller
{
    public function __construct()
    {
    }

    public function overview()
    {
        // TODO: Hook up db data 
        $couponcodes = [
            [
                'code' => 'S3F02',
                'amount' => '10.00',
                'status' => 'active',
                'active_till' => '10-07-20',
                'type' => 'delivery',
                'sort' => 'percentage',
                'min_amount_spent' => '30.00',
                'one_off' => 'true',
                'created_at' => '30-06-20'
            ],
            [
                'code' => 'S3F03',
                'amount' => '15.00',
                'sort' => 'percentage',
                'status' => 'active',
                'active_till' => '20-07-20',
                'type' => 'takeaway',
                'min_amount_spent' => '50.00',
                'one_off' => 'true',
                'created_at' => '30-06-20'
            ],
            [
                'code' => 'S3F04',
                'amount' => '5.00',
                'sort' => 'amount',
                'status' => 'active',
                'active_till' => '12-07-20',
                'type' => 'both',
                'min_amount_spent' => '20.00',
                'one_off' => 'true',
                'created_at' => '30-06-20'
            ]
        ];

        return view('admin.couponcodes.overview', [
            'couponcodes' => $couponcodes,
        ]);
    }
}
