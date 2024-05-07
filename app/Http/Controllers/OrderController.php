<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use App\Services\ProductionSchedulerService;
use Illuminate\View\View;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function __construct(private ProductionSchedulerService $productionScheduler)
    {}

    public function index(): View
    {
        $groupedOrders = Order::with('orderItems')
            ->where('end_production_date', '>', now())
            ->orderBy('need_by_date')
            ->get()
            ->groupBy(function ($order) {
                return $order->orderItems()->first()->product->type;
            });

        $schedule = $this->productionScheduler->schedule($groupedOrders);
    
        return view('production_schedule', compact('schedule'));
    }

    public function create()
    {
        $products = Product::all();

        return view('forms.create_order', compact('products'));
    }

    public function store(OrderRequest $request)
    {
        $validatedData = $request->validated();
    
        $order = Order::create([
            'customer_name' => $validatedData['customer_name'],
            'need_by_date' => $validatedData['need_by_date'],
        ]);
    
        foreach ($validatedData['product'] as $productId) {
            $quantity = $validatedData['quantities'][$productId];
            $order->orderItems()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
    
        return redirect()->route('index')->withInput();
    }    
}
