<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Order;
use App\Eloquent\OrderAddress;
use App\Helpers\Helper;

class OrderController extends Controller
{

    protected $order;

    public function __construct(
        Order $order
    ){
        $this->order = $order;
    }

    public function index()
    {
        $data['orders'] = $this->order->orderBy('id', 'desc')->paginate(15);
        $data['optionStatus'] = Order::getOptionStatus();

        return view('admin.orders.index', compact(['data']));
    }

    public function orderDetail($orderId)
    {
        $data['order'] = $this->order->with('getOrderItems')->find($orderId);
        if (!$data['order']) {
            Helper::addMessageFlashSession(__('Error'), __('Order not found!'), 'danger');

            return redirect()->route('admin.orders.index');
        }
        $data['optionStatus'] = Order::getOptionStatus();
        $data['address']['billing'] = OrderAddress::getBillingOrderAddress($orderId)->first();
        $data['address']['shipping'] = OrderAddress::getShippingOrderAddress($orderId)->first();

        return view('admin.orders.detail', compact(['data']));
    }

    public function changeStatus(Request $request, $orderId)
    {
        $order = $this->order->find($orderId);
        if (!$order) {
            Helper::addMessageFlashSession(__('Error'), __('Order not found!'), 'danger');

            return redirect()->route('admin.orders.index');
        }

        $status = $request->status;
        switch ($status) {
            case Order::STATUS_COMPLETE:
                if ($order->status == Order::STATUS_PENDING) {
                    $order->status = Order::STATUS_COMPLETE;
                    $order->save();
                    Helper::addMessageFlashSession(__('Success'), __('Create Invoice for order successfully!'), 'success');
                }
                break;
            case Order::STATUS_CANCEL:
                if ($order->status == Order::STATUS_PENDING) {
                    $order->status = Order::STATUS_CANCEL;
                    $order->save();
                    Helper::addMessageFlashSession(__('Success'), __('You canceled the order successfully!'), 'success');
                }
                break;
            case Order::STATUS_REFUND:
                if ($order->status == Order::STATUS_COMPLETE) {
                    $order->status = Order::STATUS_REFUND;
                    $order->save();
                    Helper::addMessageFlashSession(__('Success'), __('You have successfully refunded the order!'), 'success');
                }
                break;
            default:
                Helper::addMessageFlashSession(__('Error'), __('Can not perform your action!'), 'error');
        }

        return redirect()->route('admin.orders.detail', [$orderId]);
    }
}
