<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Response;
use App\Helpers\Helper;
use App\Eloquent\InforWebsite;
use App\Eloquent\User;
use App\Eloquent\Order;
use App\Eloquent\RateMedicine;
use App\Eloquent\Comment;
use App\Eloquent\Medicine;

class AdminController extends Controller
{
    public function index()
    {
        $userCollection = User::select('permission')->get();
        $orderCollection = Order::select(['status', 'grand_total'])->get();
        $commmentCollection = Comment::select('parent_id')->get();
        $rateCollection = RateMedicine::select('id')->get();
        $medicineCollection = Medicine::select('id')->get();

        $data['medicines']['total'] = $medicineCollection->count();
        $data['medicines']['reviews'] = $rateCollection->count();
        $data['comments']['questions'] = $commmentCollection->where('parent_id', null)->count();
        $data['comments']['answers'] = $commmentCollection->where('parent_id', '<>', null)->count();
        $data['orders']['total'] = $orderCollection->count();
        $data['orders']['sales'] = $orderCollection->where('status', Order::STATUS_COMPLETE)->sum('grand_total');
        $data['orders']['list'] = Order::orderBy('id', 'desc')->take(5)->get();
        $data['orders']['options'] = Order::getOptionStatus();
        $data['users']['admins'] = $userCollection->where('permission', User::PERMISSION_ADMIN)->count();
        $data['users']['users'] = $userCollection->where('permission', User::PERMISSION_USER)->count();
        $data['users']['doctors'] = $userCollection->where('permission', User::PERMISSION_DOCTER)->count();

        return view('admin.dashboard.index', compact(['data']));
    }

    public function getStaticstics(Request $request)
    {
        $paramMonth = $request->month;

        $mytime = \Carbon\Carbon::now();
        $currentTime = $mytime->format('F, Y');
        $endTimeSql = $mytime->format('Y-m'). '-' . $mytime->daysInMonth . ' 23:59:59';
       
        switch ($paramMonth) {
            case '3':
                $startTime = $mytime->modify('-3 month');
                $totalMonth = 3;
                break;
            case '9':
                $startTime = $mytime->modify('-9 month');
                $totalMonth = 9;
                break;
            case '12':
                $startTime = $mytime->modify('-12 month');
                $totalMonth = 12;
                break;
            case '18':
                $startTime = $mytime->modify('-18 month');
                $totalMonth = 18;
                break;
            case '24':
                $startTime = $mytime->modify('-24 month');
                $totalMonth = 24;
                break;
            default:
                $startTime = $mytime->modify('-6 month');
                $totalMonth = 6;
        }

        $orderCollection = Order::select(['status'])
            ->where('updated_at', '>=', $startTime->format('Y-m') . '-01 00:00:00')
            ->where('updated_at', '<=', $endTimeSql)
            ->get();

        $data['orders']['total'] = $orderCollection->count();
        $data['orders']['pending'] = $orderCollection->where('status', Order::STATUS_PENDING)->count();
        $data['orders']['complete'] = $orderCollection->where('status', Order::STATUS_COMPLETE)->count();
        $data['orders']['cancel'] = $orderCollection->where('status', Order::STATUS_CANCEL)->count();
        $data['orders']['refund'] = $orderCollection->where('status', Order::STATUS_REFUND)->count();

        for ($i = 0; $i < $totalMonth; $i++) {
            $startTime->modify('+1 month');

            if ($i == 0){
                $data['startTime'] = $startTime->format('F, Y');
            }

            $sumSales = Order::select('grand_total')
                ->where('updated_at', '>=', $startTime->format('Y-m') . '-01 00:00:00')
                ->where('updated_at', '<=', $startTime->format('Y-m'). '-' . $startTime->daysInMonth . ' 23:59:59')
                ->where('status', Order::STATUS_COMPLETE)
                ->get()->sum('grand_total');

            $data['labels'][] = $startTime->format('m-y');
            $data['data'][] = $sumSales;
        }

        $data['label'] = __('Staticstics sales');
        $data['endTime'] = $currentTime;

        return Response::json($data);
    }

    public function setup(Request $request)
    {
        $setup = InforWebsite::where('position', InforWebsite::POSITION_MAIN)->first();
        if (!$setup) {
            $setup = new InforWebsite;
        }

        if ($request->isMethod('get')) {
            $optionOrdered = InforWebsite::getOptionOrdered();

            return view('admin.dashboard.setup', compact(['setup', 'optionOrdered']));
        }

        if ($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'slogan' => 'required|max:255',
                'logo' => 'image',
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.setup')->withErrors($validator);
            }

            $setup->fill($request->except(['logo']));
            $setup->position = InforWebsite::POSITION_MAIN;
            $setup->options = json_encode([
                'ordered_out_stock' => $request->ordered_out_stock,
                'contact_email' => $request->contact_email,
            ]);

            $linkKeywords = is_array($request->keyword) ? $request->keyword : [];
            $linkValues = is_array($request->link) ? $request->link : [];
            $linkCommucications = [];

            foreach ($linkKeywords as $key => $linkKeyword) {
                $linkCommucications[$linkKeyword] = $linkValues[$key];
            }
            $setup->link_communications = json_encode($linkCommucications);

            if ($request->hasFile('logo')) {
                Helper::deleteFile($setup->logo);
                $request->logo->hashName();
                $path = $request->file('logo')->store('uploads/logos/', 'uploads');
                $setup->logo = $path;
            }

            try {
                $setup->save();
                $message = __('Save successfully!');
                Helper::addMessageFlashSession(__('Success'), $message, 'success');
            } catch (Exception $e){
                Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');
            }
        }
        
        return redirect()->route('admin.setup');
    }
}
