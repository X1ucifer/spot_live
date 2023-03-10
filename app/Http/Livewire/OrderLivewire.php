<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\CouponUser;



class OrderLivewire extends NewOrderLivewire
{

    //
    public $model = Order::class;

    //
    public $orderId;
    public $deliveryBoys;
    public $deliveryBoyId;
    public $status;
    public $paymentStatus;
    public $note;
    public $couponCode;

    //
    public $orderStatus;
    public $orderPaymentStatus;



    public function render()
    {
        return view('livewire.orders');
    }


    public function loadCustomData()
    {
        $this->deliveryBoys = User::role('driver')->get();
        $this->paymentMethods = PaymentMethod::active()->get();

        //if vendor has any personal delivery boy, use that list instead
        if (!empty(Auth::user()->vendor_id)) {
            $personalDrivers = User::role('driver')->where('vendor_id', Auth::user()->vendor_id)->get();
            if (count($personalDrivers) > 0) {
                $this->deliveryBoys = $personalDrivers;
            } else {
                $this->deliveryBoys = User::role('driver')->whereNull('vendor_id')->get();
            }
        }

        $this->orderStatus = $this->orderStatus();
        $this->orderPaymentStatus = $this->orderPaymentStatus();
    }

    public function showDetailsModal($id)
    {
        $this->selectedModel = $this->model::find($id);
        $this->orderId = $id;
        $this->showDetails = true;
        $this->stopRefresh = true;
    }

    // Updating model
    public function initiateEdit($id)
    {
        $this->selectedModel = $this->model::find($id);
        // Log::debug("anbe-->". $this->selectedModel);


        // $this->id = $this->selectedModel->id;
        $this->deliveryBoyId = $this->selectedModel->driver_id;
        $coupon1 = $this->selectedModel->coupon_code;
        $this->status = $this->selectedModel->status;
        $this->paymentStatus = $this->selectedModel->payment_status;
        $this->note = $this->selectedModel->note;
        $this->loadCustomData();
        $this->emit('preselectedDeliveryBoyEmit', \Str::ucfirst($this->selectedModel->driver->name ?? '') );
        $this->emit('showEditModal');

        if($this->selectedModel->status == "enroute"){
            $coupon = Coupon::where("code", $coupon1 )->first();
            if (!empty($coupon)) {
                $couponUser = new CouponUser();
                $couponUser->coupon_id = $coupon->id;
                $couponUser->user_id = $this->selectedModel->user_id;
                $couponUser->order_id =  $this->selectedModel->id;
                $couponUser->save();
            }
  Log::debug("inisde -->". $coupon1);
        }

        Log::debug("outside-->". $coupon1);

    }


    public function update()
    {

        try {

            DB::beginTransaction();
            $this->selectedModel->driver_id = $this->deliveryBoyId ?? null;
            $this->selectedModel->payment_status = $this->paymentStatus;
            $this->selectedModel->note = $this->note;
            $this->selectedModel->setStatus($this->status);
            $this->selectedModel->save();
            DB::commit();


            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Order")." ".__('updated successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert( $error->getMessage() ?? __("Order")." ".__('updated failed!'));
        }
    }



    //reivew payment
    public function reviewPayment($id)
    {
        //
        $this->selectedModel = $this->model::find($id);
        $this->emit('showAssignModal');
    }

    public function approvePayment()
    {
        //
        try {

            DB::beginTransaction();
            $this->selectedModel->payment_status = "successful";
            $this->selectedModel->save();
            //TODO - Issue fetch payment when prescription is been edited
            $this->selectedModel->payment->status = "successful";
            $this->selectedModel->payment->save();
            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Order")." ".__('updated successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert( $error->getMessage() ?? __("Order")." ".__('updated failed!'));
        }
    }



    //
    public function showEditOrderProducts(){
        $this->closeModal();
        $this->stopRefresh = true;
        $this->emit('showEditProducts', $this->selectedModel);
    }





}
