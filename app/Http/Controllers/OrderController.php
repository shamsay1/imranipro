<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\SystemUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class OrderController extends Controller
{
    public function checkout(Request $request)
{
    $cart = $request->cart;

    foreach ($cart as $item) {

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'total_price' => $item['total'],
            'status' => 'pending',
        ]);
        
    }

    return response()->json(['message' => 'Order created']);
}
    public function ordersPage()
{
    $orders = Order::with(['user', 'product'])
                ->latest()
                ->get()
                ->groupBy('user_id');

    return view('orderResponse', compact('orders'));
}
    public function sendResponse($userId)
{
    $user = SystemUser::find($userId);
    Order::where('user_id', $userId)->update([
    'status' => 'confirmed'
    ]);
    $orders = Order::with('product')
        ->where('user_id', $userId)
        ->get();

    $totalCost = 0;

    $message = "Hello {$user->firstname} {$user->middlename} {$user->lastname},\n\n";
    $message .= "Here is your order summary:\n\n";

    foreach ($orders as $order) {
        $line = "{$order->product->product_name} | Qty: {$order->quantity} | Cost: {$order->total_price}";
        $message .= "- {$line}\n";
        $totalCost += $order->total_price;
    }

    $message .= "\n---------------------------------\n";
    $message .= "TOTAL COST: TZS {$totalCost}\n\n";
    $message .= "Please pay TZS {$totalCost} to receive your products.\n";
    $message .= "Thank you for shopping with us.";

    Mail::raw($message, function($mail) use ($user) {
        $mail->to($user->email)
            ->subject('Order Invoice - Payment Required');
    });


    return back()->with('success', 'Invoice sent successfully');
}
        public function orderHistory()
{

    $orders = Order::with('product')
        ->where('user_id', Auth::user()->id)
        ->latest()
        ->get()
        ->groupBy(function ($order) {
            return $order->created_at->format('Y-m-d');
        });

    $grandTotal = Order::where('user_id', Auth::user()->id)->sum('total_price');

    return view('orderhistory', compact('orders', 'grandTotal'));
}
}
