<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\User;
use App\Order;
use App\Professional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        //$orders = Order::paginate(10)->where('is_received','=','0')->where('is_paid','=','1')->sortBy('created_at');
        $users = User::count();
        $orders = Order::current()->count();
        $contacts = Contact::where('is_read', false)->count();
        $completed_order = Order::history()->count();
        $professionals = Professional::where('is_accepted', true)->count();
        $professionals_not_validate = Professional::where('is_requested', true)->count();

        return view('admin/dashboard', [
            'users' => $users,
            'orders' => $orders,
            'contacts' => $contacts,
            'completed_order' => $completed_order,
            'professionals' => $professionals,
            'professionals_not_validate' => $professionals_not_validate
        ]);
    }
}
