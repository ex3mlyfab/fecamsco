<?php

namespace App\Http\Livewire;

use App\Models\ProductService;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreatePurchaseOrder extends Component
{

    public $supplier_id;
    public $purchase_order = [];
    public $products;
    public $suppliers;
    public $adding = [''];
    public $orderTotal = 0;

    public function mount()
    {
        $this->products = ProductService::all();
        $this->suppliers = Supplier::all();

    }

    // public function updated($key,$value){
    //     $parts = explode(".", $key);
    //     dd($parts);

    //     if(count($parts) == 3 && $parts[0] == "purchase_order") {
    //         // dd($value);
    //         $products = $this->products->where('id', $value )->first()->id;
    //         if($products){
    //             $this->purchase_order[$parts[1]]["product_service_id"] = $products;
    //         }
    //     }

    // }
    public function addOrder(){
        $this->adding[] = " ";
    }
    public function calculateTotal($index)
    {
        // foreach($this->purchase_order[$index] as $item){
        //     if($item["quantity"] == "quantity")
        // }
        $load= $this->purchase_order[$index];
        $quantity = $load["quantity"] ?? 0;
        $price = $load["price"]?? 0;

    //   $product_service_id = $load["product_service_id"];
    //   if(in_array($product_service_id, $this->purchase_order[]))
        if((isset($quantity)&& is_numeric($quantity)) && (isset($price)&&(is_numeric($price)))){
            $this->purchase_order[$index]["total"] = $quantity * $price;
        }

        $this->rowTotal();
        $this->removeDuplicateRow($load['product_service_id'], $index);
    }
    public function rowTotal(){
        $rowTotal = 0;

            foreach($this->purchase_order as $key => $value){

            $loader = $this->purchase_order[$key];
            $quantity = $loader["quantity"] ?? 0;
            $price = $loader["price"]?? 0;
            $rowTotal +=  $quantity * $price;
        }

        $this->orderTotal = $rowTotal;
    }
    public function removeDuplicateRow($product_id, $identity)
    {

        $count = 0;
        foreach($this->purchase_order as $key => $value){
            $loader = $this->purchase_order[$key];
            $testing_id = $loader['product_service_id'];
            if($product_id == $testing_id)
            {
                $count ++;
            }
            if($count > 1){
                $this->removeOrder($identity);
            }
        }

    }
    public function removeOrder($index)
    {
        unset($this->adding[$index]);
        unset($this->purchase_order[$index]);
        $this->adding = array_values($this->adding);
        $this->purchase_order = array_values($this->purchase_order);
        $this->rowTotal();

    }

    public function store()
    {
        $this->validate([
            'supplier_id' => 'required',
            'purchase_order.*.product_service_id' => 'required',
            'purchase_order.*.quantity' => 'required',
            'purchase_order.*.price' => 'required',
        ]);
        DB::transaction(function () {
            $newpurchaseorder = PurchaseOrder::create([
                'supplier_id' => $this->supplier_id,
                'created_by' =>auth()->user()->id,
                'status' => 1
            ]);
            $prevaricate = $this->purchase_order;
            // dd($prevaricate);
                $totalOrder = 0;
                foreach($prevaricate as $key => $value){
                // dd($this->purchase_order);
                $load= $this->purchase_order[$key];

                    $newpurchaseorder->purchaseOrderDetails()->create([
                        'product_service_id' => $load["product_service_id"],
                        'price' => $load["price"],
                        'quantity' => $load["quantity"],
                        'status' => 1
                    ]);
                    $totalOrder += $load['price']* $load['quantity'];
                }
            $newpurchaseorder->update([
                'total' =>  $totalOrder
            ]);
        });
        $this->purchase_order = [];
        $this->adding = [''];
        $this->supplier_id ="";

        redirect()->route('purchase-order.all')->with('message', 'purchase order created successfully');
    }
    public function render()
    {
        return view('livewire.create-purchase-order');
    }
}
