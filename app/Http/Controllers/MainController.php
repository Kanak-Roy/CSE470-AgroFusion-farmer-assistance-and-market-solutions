<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;


class MainController extends Controller
{
    
    //akanto- add item into cart
    public function index()
    {
        $allProducts = Product::all();
        $newArrival = Product::where('type', 'new-arrivals') ->get();
        $hotSale = Product::where('type', 'sale') ->get();
        return view('index', compact('allProducts', 'hotSale', "newArrival"));
    }

    //akanto- show item in cart
    public function cart()
    {
        $cartItems = DB::table('products')
        ->join('carts', 'carts.productID', 'products.id')
        ->select('products.title', 'products.quantity as pQuantity', 'products.price', 'products.picture', 'carts.*')
        ->where('carts.customerID', session()->get('id'))
        ->get();
        return view('cart', compact('cartItems'));
    }
    //
    // public function checkout()
    // {
    //     return view('checkout');
    // }
    //akanto
    public function shop()
    {
        $allProducts = Product::all();
        
        return view('shop', compact('allProducts'));
    }
    //
    public function singleProduct($id)
    {
        $product=Product::find($id);
        return view('singleProduct', compact('product'));
    }
    //search product
    public function searchProduct(Request $data)
    {
        $query = $data->input('query');
        $product = Product::where('title', 'like', '%' . $query . '%')->first();
        if ($product) {
            return redirect()->to('single/' . $product->id);
        }
        return redirect()->back()->with('error', 'Product not found');
    }

    //sort and category product
    public function sortProduct(Request $data)
    {
        $sortBy = $data->input('sort_by', 'asc');
        $categories = Product::select('category', DB::raw('count(*) as total'))
                             ->groupBy('category')
                             ->get();

        $query = Product::query();

        if ($data->has('category')) {
            $query->where('category', $data->input('category'));
        }
 
        $allProducts = $query->orderBy('price', $sortBy)->get();

        return view('shop', compact('categories', 'allProducts'));
    }
    

    //---------------  for login method -------------------------
    //
    public function login()
    {
        return view('login');
    }

    //
    public function loginUser(Request $data)
    {
        $user=User::where('email',$data->input('email'))->where('password',$data->input('password'))->first();
        if($user)
        {
            if($user->status=="Blocked")
            {
                return redirect('login')->with('error','Your are Blocked and Unauthorize to view any pages');
            }
            session()->put('id',$user->id);
            session()->put('type',$user->type);
            if($user->type=='Customer')
            {
                return redirect('/');
            }
            else if($user->type=='Admin')
            {
                return redirect('/admin');
            }
            else if($user->type=='Agent')
            {
                return redirect('/agent');
            }
        }else
        {
            return redirect('login')->with('error','Email/Password is incorrect');
        }

    }

    //---------------  for registration method -------------------------
    //
    public function register()
    {
        return view('register');
    }
    
    //
    public function registerUser(Request $data)
    {
        $newUser= new User();
        $newUser->fullname=$data->input('fullname');
        $newUser->email=$data->input('email');
        $newUser->password=$data->input('password');
        $newUser->picture=$data->file('file')->getClientOriginalName();
        $data->file('file')->move('uploads/profiles/',$newUser->picture);
        $newUser->type="Customer";

        if($newUser->save())
        {
            return redirect('login')->with('success','Congratulation! Your account is created');
        }
        
    }

    //---------------  for logout method -------------------------
    public function logout()
    {
        session()->forget('id');
        session()->forget('type');
        return redirect('/login');

    }
    //---------------  for Update profile method -------------------------
    public function profile()
    {
       if(session()->has('id'))
       {
            $user=User::find(session()->get('id'));

            return view('profile',compact('user'));
       }
        return redirect('login');

    }

    public function updateUser(Request $data)
    {
        $user= User::find(session()->get('id'));
        $user->fullname=$data->input('fullname');
        
        if($data->file('file')!=null)
        {
        $user->picture=$data->file('file')->getClientOriginalName();
        $data->file('file')->move('uploads/profiles/',$user->picture);

        }
 

        if($user->save())
        {
            return redirect()->back()->with('success','Contratulation! Your account is updated');
        }
        
    }
    //add to cart-akanto
    public function addToCart(Request $data)
    {
        if (session()->has('id'))
        {
            $item = new Cart();
            $item->quantity=$data->input('quantity');
            $item->productID=$data->input('id');
            $item->customerID=session()->get('id');
            $item->save();
            return redirect()->back()->with('success','Contratulation! Item added into cart.');
        }
        else
        {
            return redirect('login')->with('error','Info! Please Login to system');
        }
    }

    //update cart-akanto
    public function updateCart(Request $data)
    {
        if (session()->has('id'))
        {
            $item = Cart::find($data->input('id'));
            $item->quantity=$data->input('quantity');
            $item->save();
            return redirect()->back()->with('success','Success! Items quantity updated.');
        }
        else
        {
            return redirect('login')->with('error','Info! Please Login to system');
        }
    }

    //delete cart item-akanto
    public function deleteCartItem($id)
    {
        $item = Cart::find($id);
        $item->delete();
        return redirect()->back()->with('success','1 Item has been deleted from cart.');
    }


    // Done by Kanak
    public function checkout(Request $data)
    {
        if (session()->has('id'))
        {
            $order = new Order();
            $order->status="Pending";
            $order->customerId=session()->get('id');
            $order->bill=$data->input("bill");
            $order->address=$data->input("address");
            $order->fullname=$data->input("fullname");
            $order->phone=$data->input("phone");
            if($order->save())
            {
                $carts=Cart::where("customerId",session()->get("id"))->get();
                foreach($carts as $item)
                {
                    $product = Product::find($item->productID);
                    $orderItem=new OrderItem();
                    $orderItem->productID=$item->productID;
                    $orderItem->quantity=$item->quantity;
                    $orderItem->price=$product->price;
                    $orderItem->orderId=$order->id;
                    $orderItem->save();
                    $item->delete();
                }
            }
            
            return redirect()->back()->with('success','Success! Your order has been placed successfully');
        }
        else
        {
            return redirect('login')->with('error','Info! Please Login to system');
        }
    }

    public function myOrders()
    {
       if(session()->has('id'))
       {
            $orders=Order::where("customerId", session()->get('id'))->get();
            $items=DB::table('products')
            ->join("order_items", "order_items.productId", "products.id")
            ->select("products.title", "products.picture", "order_items.*")
            ->get();

            return view('orders',compact('orders', 'items'));
       }
        return redirect('login');

    }


}


