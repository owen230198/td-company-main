<?php

namespace App\Http\Controllers;

use App\Models\COrder;
use App\Models\Notify;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getDataOrderCountByMonth()
    {
        $orders = \DB::table('orders')
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as order_count')
        ->whereYear('created_at', now()->year)
        ->groupBy(\DB::raw('MONTH(created_at)'))
        ->pluck('order_count', 'month');
        $orderCounts = array_fill(1, 12, 0);
        foreach ($orders as $month => $count) {
            $orderCounts[$month] = $count;
        }
        return $orderCounts;
    }

    public function getTopSellingByUser()
    {
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek();
        return \DB::table('c_orders')
            ->select('created_by', \DB::raw('COUNT(*) as count'))
            ->where(['type' => COrder::SELL])
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('created_by')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get()->map(function($item){
                $item->sale_name = getFieldDataById('name', 'n_users', $item->created_by);
                return $item;
            });
    }

    public function index(Request $request)
    {
        if (!$request->isMethod('GET')) {
            return 'Yêu cầu không hợp lệ !';
        }
        $data['title'] = 'phần mềm doanh nghiệp '. getDataConfig('QuoteConfig', 'COMPANY_NAME');
        $notify_obj = Notify::where(['act' => 1]);
        if (!\GroupUser::isAdmin()) {
            $notify_obj->where('group_user', \GroupUser::getCurrent())->orWhere('user', \User::getCurrent('id'));
        }
        $data['noftify_count'] = $notify_obj->count();
        $data['notify_list'] = $notify_obj->orderBy('id', 'DESC')->get()->take(10);
        $data['not_accepted_table'] = \App\Constants\OrderConstant::ACCEPT_REQURIRED_TABLE;
        $data['chart_data'] = $this->getDataOrderCountByMonth();
        $data['selling_chat'] = $this->getTopSellingByUser();
        return view('main', $data); 
    }
}

