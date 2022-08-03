<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pipeline;
use App\Models\TeamSales;
use App\Models\TeamSalesGroup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $view_page = 'pages.';
    private $status = ['Prospecting', 'Leads', 'Hot Leads', 'Closed Lost', 'Closed Won'];

    public function index()
    {
        $page = $this->view_page . 'admin.dashboard';

        //get number of sales staff
        $salesStaffCount = User::where('user_role', 3)->count();

        //get number of customer
        $customerCount = 0;

        $totalRevenue = 0;
        $NumberPipeline = 0;

        $data = [
            'sales_person_count' => $salesStaffCount,
            'customer_count' => $customerCount,
            'status' => $this->status,
            'pipeline_count' => $NumberPipeline,
            'total_revenue' => $totalRevenue,
            'title' => 'Dashboard',
            'sidebar_title' => 'dashboard',
        ];

        return view($page, $data);    
    }
}
