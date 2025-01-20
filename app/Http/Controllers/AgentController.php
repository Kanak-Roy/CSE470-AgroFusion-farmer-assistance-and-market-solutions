<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
    public function index()
    {
        if(session()->get('type')=='Agent')
        {
            return view('agentDashboard.index');
        }
        return redirect()->back();
    }


    //
    
    public function agentProfile()
    {
        if(session()->get('type')=='Agent')
        {
            $user=User::find(session()->get('id'));
            return view('agentDashboard.agentprofile',compact('user'));
        }
        return redirect()->back();
    }
    //add products
    public function addproducts()
    {
        if(session()->get('type')=='Agent')
        {
            $products = Product::all();
            return view('agentDashboard.addproducts', compact('products'));
        }
        return redirect()->back();
    }

    //add new products
    public function addnewproduct(Request $data)
    {
        if(session()->get('type')=='Agent')
        {
            $products= new Product();
            $products->title=$data->input('title');
            $products->price=$data->input('price');
            $products->quantity=$data->input('quantity');
            $products->type=$data->input('type');
            $products->category=$data->input('category');
            $products->description=$data->input('description');
            $products->picture=$data->file('file')->getClientOriginalName();
            $data->file('file')->move('uploads/products/',$products->picture);
            $products->save();
            return redirect()->back()->with('success','Congratulation! New product is added');
        }
        return redirect()->back();
    }
     
     //delete product
    public function deleteproduct($id)
    {
        if(session()->get('type')=='Agent')
        {
            $product= Product::find($id);
            $product->delete();
            return redirect()->back()->with('success','Congratulation! Product is deleted successfully');
        }
        return redirect()->back();
    }
    

}
