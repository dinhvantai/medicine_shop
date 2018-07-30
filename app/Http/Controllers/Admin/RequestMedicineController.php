<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Eloquent\RequestMedicine;

class RequestMedicineController extends Controller
{
    
    protected $requestMedicine;

    public function __construct(RequestMedicine $requestMedicine)
    {
        $this->requestMedicine = $requestMedicine;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestMedicine = $this->requestMedicine
            ->with('getUser')
            ->orderBy('id', 'desc')->paginate(15);

        $data['requestMedicine'] = $requestMedicine;

        return view('admin.request.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requestMedicine = $this->requestMedicine
            ->with('getUser', 'getAllImages')->find($id);
            
        if (!$requestMedicine) {
            $message = __('Request Medicine not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');
            
            return redirect()->route('request.index');
        }
        $data['requestMedicine'] = $requestMedicine;
        $data['option'] = RequestMedicine::getOptionStatus();

        return view('admin.request.view', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestMedicine = $this->requestMedicine->find($id);
        if (!$requestMedicine) {
            $message = __('Request Medicine not found!');
            Helper::addMessageFlashSession(__('Error'), $message, 'danger');
            
            return redirect()->route('request.index');
        }

        $requestMedicine->fill($request->only(['status', 'respone_admin']));
        try {
            $requestMedicine->save();
            $message = __('Save successfully!');
            Helper::addMessageFlashSession(__('Success'), $message, 'success');
        } catch(Exception $e) {
            Helper::addMessageFlashSession(__('Error'), $e->getMessage(), 'danger');
        }

        return redirect()->route('request.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
