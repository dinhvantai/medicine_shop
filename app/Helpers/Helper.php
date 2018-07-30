<?php

namespace App\Helpers;

use Session;
use Auth;
use App\Eloquent\Image;
use App\Eloquent\User;
use App\Eloquent\RelatedDoctorRequest;
use App\Eloquent\RequestPrescription;
use App\Eloquent\InforWebsite;
use App\Eloquent\Order;
use App\Eloquent\OrderAddress;
use App\Eloquent\Medicine;

class Helper
{

    public static function getCurrentLanguage()
    {
        return Session::get('language', 'vn');
    }

    public static function setLanguage($lang = 'vn')
    {
        Session::put('language', $lang);
    }

    public static function changeLanguage()
    {
        $language = self::getCurrentLanguage();
        switch ($language) {
            case 'en':
                $language = 'en';
                break;
            
            default:
                $language = 'vn';
                break;
        }
        
        config(['app.locale' => $language]);
    }

    public static function addMessageFlashSession($title, $message, $type = 'success')
    {
        $messages = Session::get('flash_messages', []);
        $messages[] = ['title' => $title, 'message' => $message, 'type' => $type];
        Session::flash('flash_messages', $messages);
    }

    public static function addMessageFlashFrontendSession($title, $message, $type = 'success')
    {
        $messages = Session::get('flash_frontend_messages', []);
        $messages[] = ['title' => $title, 'message' => $message, 'type' => $type];
        Session::flash('flash_frontend_messages', $messages);
    }

    public static function addItemToCart($itemId, $qtyOrder, $price, $rowTotal, $mediId = '', $mediName = '')
    {
        $carts = Session::get('frontend_cart', []);
        $carts[$itemId] = [
            'qty_ordered' => $qtyOrder,
            'price' => $price,
            'row_total' => $rowTotal,
            'medicine_id' => $mediId,
            'medicine_name' => $mediName,
        ];
        Session::put('frontend_cart', $carts);
    }

    public static function getCarts()
    {
        return Session::get('frontend_cart', []);
    }

    public static function emptyCarts()
    {
        return Session::put('frontend_cart', []);
    }

    public static function saveOrderAddress($orderId, $data, $typeAddress = OrderAddress::TYPE_BILLING)
    {
        $orderAddress = new OrderAddress;
        $orderAddress->order_id = $orderId;
        $orderAddress->address_type = $typeAddress;
        $orderAddress->user_email = isset($data['user_email']) ? $data['user_email'] : 'guest';
        $orderAddress->user_display_name = isset($data['user_display_name']) ? $data['user_display_name'] : 'guest';
        $orderAddress->user_address = isset($data['user_address']) ? $data['user_address'] : 'guest';
        $orderAddress->user_phone = isset($data['user_phone']) ? $data['user_phone'] : 'guest';
        $orderAddress->user_gender = User::GENDER_OTHER;

        return $orderAddress->save();
    }

    public static function getSetupAllowOrder()
    {
        $setup = InforWebsite::getInfoWebsite()->first();
        $allowOrdered = config('custom.order.ordered_out_stock');
        if ($setup) {
            $options = json_decode($setup->options, true);
            if (isset($options['ordered_out_stock'])) $allowOrdered = $options['ordered_out_stock'];
        }

        return $allowOrdered;
    }

    public static function getEmailContactTo()
    {
        $setup = InforWebsite::getInfoWebsite()->first();
        $email = config('custom.contact.default_email');
        if ($setup) {
            $options = json_decode($setup->options, true);
            if (isset($options['contact_email'])) $email = $options['contact_email'];
        }

        return $email;
    }

    public static function changeQuantityMedicine($medicineId, $quantity = 0)
    {
        $medicine = Medicine::find($medicineId);
        if ($medicine && $quantity != 0) {
            $medicine->quantity = $medicine->quantity - $quantity;
            $medicine->save();
        }
    }

    public static function deleteFile($path)
    {
        if (is_file($path)) {
            unlink($path);
        }
    }

    public static function saveImageMedicine($mediId, $pathOrigin, $pathThumb, $isMain = 1)
    {
        $image = new Image;
        $image->medicine_id = $mediId;
        $image->path_origin = $pathOrigin;
        $image->path_thumb = $pathThumb;
        $image->is_main = $isMain;

        return $image->save();
    }

    public static function getLinkUserAvatar($path)
    {
        if (!$path) {
            return url(config('custom.user.avatar_default'));
        }
        if (strpos($path, 'http')) {
            return $path;
        }
        
        return url($path);
    }

    public static function formatPrice($price)
    {
        $format = new \NumberFormatter(config('custom.price.locale_format'), \NumberFormatter::CURRENCY);

        return $format->format($price);
    }

    public static function getSymbolCurrency()
    {
        $format = new \NumberFormatter(config('custom.price.locale_format'), \NumberFormatter::CURRENCY);

        return $format->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    }

    public static function numberIntegerFormat($number)
    {
        return number_format($number);
    }

    public static function numberFloatFormat($number)
    {
        return number_format($number, 2);
    }

    public static function createOrGetUserSocial($provider, $providerName)
    {
        $account = User::where('provider', $providerName)
            ->where('provider_user_id', $provider->getId())
            ->first();

        if (!$account) {
            $email = $provider->getEmail();
            $issetEmail = User::withTrashed()->where('email', $email)->first();

            if ($issetEmail || !$email) {
                $email = $providerName . '.' .$provider->getId() . '@gmail.com';
            }

            $account = new User([
                'provider_user_id' => $provider->getId(),
                'provider' => $providerName,
                'email' => $email,
                'display_name' => $provider->getName(),
            ]);

            if ($provider->getAvatar()) {
                $account->avatar = $provider->getAvatar();
            }

            $account->save();
        }

        return $account;
    }

    public static function countNewRequestPrescriptionDoctor()
    {
        $result = 0;
        
        if (Auth::check() && Auth::user()->permission == User::PERMISSION_DOCTER) {
            $allRequests = RelatedDoctorRequest::where('doctor_id', Auth::user()->id)
                ->where('status', RelatedDoctorRequest::STATUS_NEW)->get();

            $result = $allRequests->count();
        }

        return $result;
    }
}
