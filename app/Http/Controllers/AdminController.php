<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    
    public function index()
    {
        if(session()->get('type')=='Admin')
        {
            return view('adminDashboard.index');
        }
        return redirect()->back();
    }


    //
    
    public function adminProfile()
    {
        if(session()->get('type')=='Admin')
        {
            $user=User::find(session()->get('id'));
            return view('adminDashboard.adminprofile',compact('user'));
        }
        return redirect()->back();
    }
    //
    
    public function addagents()
    {
        if(session()->get('type')=='Admin')
        {
            $addagents=User::where('type','Agent')->get();
            return view('adminDashboard.addagents',compact('addagents'));
        }
        return redirect()->back();
    }

    //
    public function addnewagents(Request $data)
    {
        if(session()->get('type')=='Admin')
        {
            $newUser= new User();
            $newUser->fullname=$data->input('fullname');
            $newUser->email=$data->input('email');
            $newUser->password=$data->input('password');
            $newUser->picture=$data->file('file')->getClientOriginalName();
            $data->file('file')->move('uploads/profiles/',$newUser->picture);
            $newUser->type="Agent";
            $newUser->save();
            return redirect()->back()->with('success','Congratulation! New Agent is created');
        }
        return redirect()->back();
    }

    //
    
    public function ourCustomers()
    {
        if(session()->get('type')=='Admin')
        {
            $customers=User::where('type','Customer')->get();
            return view('adminDashboard.customersstatus',compact('customers'));
        }
        return redirect()->back();
    }
    //
    public function changeUserStatus($status,$id)
    {
        if(session()->get('type')=='Admin')
        {
            $user=User::find($id);
            $user->status=$status;
            $user->save();
            return redirect()->back()->with('success','Contratulation! user status change successfully');
        }
        return redirect()->back();
    }

    //
    public function ourAgents()
    {
        if(session()->get('type')=='Admin')
        {
            $agents=User::where('type','Agent')->get();
            return view('adminDashboard.agentsstatus',compact('agents'));
        }
        return redirect()->back();
    }

    public function changeAgentStatus($status,$id)
    {
        if(session()->get('type')=='Admin')
        {
            $user=User::find($id);
            $user->status=$status;
            $user->save();
            return redirect()->back()->with('success','Contratulation! user status change successfully');
        }
        return redirect()->back();
    }

    // Done by Kanak
    public function orders()
    {
        if(session()->get('type')=='Admin')
        {
            $orderItems=DB::table('order_items')
            ->join('products', 'order_items.productId', 'products.id')
            ->select('products.title', 'products.picture', 'order_items.*')
            ->get();
            $orders=DB::table('users')
            ->join('orders', 'orders.customerId', 'users.id')
            ->select('orders.*', 'users.fullname', 'users.email', 'users.status as userStatus')
            ->get();
            return view('Dashboard.orders',compact('orders', 'orderItems'));
        }
        return redirect()->back();
    }

    public function changeOrderStatus($status,$id)
    {
        if(session()->get('type')=='Admin')
        {
            $order=Order::find($id);
            $order->status=$status;
            $order->save();
            return redirect()->back()->with('success','Contratulation! Order status change successfully');
        }
        return redirect()->back();
    }

}
