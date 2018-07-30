<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{{ $subject }}</title>
        <meta name="viewport" content="width=device-width" />
           <style type="text/css">
                @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                    body[yahoo] .buttonwrapper { background-color: transparent !important; }
                    body[yahoo] .button { padding: 0 !important; }
                    body[yahoo] .button a { background-color: #ff6b6b; padding: 15px 25px !important; }
                }

                @media only screen and (min-device-width: 601px) {
                    .content { width: 600px !important; }
                    .col387 { width: 387px !important; }
                }
                .table-order-td {
                    padding: 10px 20px;
                    font-family: Arial, sans-serif;
                    border: 1px solid #fff;
                }
                .table-head-td {
                   padding: 10px 20px;
                   color: #555555;
                   font-family: Arial, sans-serif; 
                   font-size: 20px;
                   line-height: 30px;
                   border-bottom: 1px solid #f6f6f6; 
                }
                .table-address-td {
                    width: 50%; 
                    background-color: #b8e5cb;
                    padding: 0px 10px;
                    font-size: 14px;
                }
                p {
                    margin-top: 0px;
                    margin-bottom: 0px;
                }
        </style>
    </head>
    <body bgcolor="#f7f7f7" style="margin: 0; padding: 0;" yahoo="fix">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; border: 1px solid #CDCDCD" class="content">
            <tr>
                <td align="center" bgcolor="#ff6b6b" class="table-head-td" style="font-weight: bold;">
                    {{ $subject }}
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" class="table-head-td">
                    <strong>{{ __('Your order has been received.') }}</strong><br/>
                    <span>
                        <small>{{ __('You will receive an order confirmation email with details of your order and a link to track its progress.') }}</small>
                    </span>
                </td>
            </tr>
             <tr>
                <td align="center" bgcolor="#b8e5cb" class="table-head-td">
                    @if (isset($order))
                        <small>{{ __('Your order # is:') }}</small>
                        <a href="{{route('frontend.order.detail', [$order->id])}}">#{{ $order->id }}</a>
                        <br><small>{{ __('Status: :status', ['status' => $option_status[$order->status]]) }}</small>
                    @endif
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#ffffff" class="table-head-td">
                    <table class="content">
                        <tr>
                            <td class="table-address-td" style="text-align: left;">
                                @if (isset($address['billing']))
                                    <p class="page-header"><strong>{{ __('Billing Address') }}</strong></p>
                                    <strong>{{ $address['billing']->user_display_name }}</strong>
                                    <address>
                                        <span>{{ __('Tel:') }}{{ $address['billing']->user_phone }}</span>,
                                        <span>{{ $address['billing']->user_address }}</span><br>
                                        <a href="javascript:void(0)">{{ $address['billing']->user_email }}</a>
                                    </address>
                                @endif
                            </td>
                            <td class="table-address-td" style="text-align: right;">
                                @if (isset($address['shipping']))
                                    <p class="page-header"><strong>{{ __('Shipping Address') }}</strong></p>
                                    <strong>{{ $address['shipping']->user_display_name }}</strong>
                                    <address>
                                        <span>{{ __('Tel:') }}{{ $address['shipping']->user_phone }}</span>,
                                        <span>{{ $address['shipping']->user_address }}</span><br>
                                        <a href="javascript:void(0)">{{ $address['shipping']->user_email }}</a>
                                    </address>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#f9f9f9" class="table-order-td">
                    <table bgcolor="#b8e5cb" border="0" cellspacing="0" cellpadding="0" class="content">
                        <thead>
                            <tr>
                                <th class="table-order-td">{{ __('Medicine') }}</th>
                                <th class="table-order-td">{{ __('Qty ordered') }}</th>
                                <th class="table-order-td">{{ __('Price') }}</th>
                                <th class="table-order-td">{{ __('Row Total') }}</th>
                            </tr>
                        </thead>
                        @if (isset($order))
                            @foreach ($order->getOrderItems as $item)
                                <tr>
                                    <td class="table-order-td">
                                        <strong>{{ $item->medicine_name }}</strong><br/>
                                    </td>
                                    <td class="table-order-td" align="center">
                                        {{ App\Helpers\Helper::numberIntegerFormat($item->qty_ordered) }}
                                    </td>
                                    <td class="table-order-td" style="text-align: right;">
                                        {{ App\Helpers\Helper::formatPrice($item->price) }}
                                    </td>
                                    <td class="table-order-td" style="text-align: right;">
                                        <strong>{{ App\Helpers\Helper::formatPrice($item->row_total) }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="active">
                                <td colspan="3" class="table-order-td" style="text-align: right;">
                                    <strong>{{ __('Grand Total') }}</strong>
                                </td>
                                <td class="table-order-td" style="text-align: right;">
                                    <strong>{{ App\Helpers\Helper::formatPrice($order->grand_total) }}</strong>
                                </td>
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b>{{ __('Framgia Medicine') }}</b>
                </td>
            </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
    </body>
</html>
