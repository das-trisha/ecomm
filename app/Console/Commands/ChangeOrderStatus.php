<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class ChangeOrderStatus extends Command
{
    protected $signature = 'orders:change-status';
    protected $description = 'Change order status from processing to delivered for all orders';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $processingOrders = Order::where('delivery_status', 'processing')->get();

        if ($processingOrders->isEmpty()) {
            $this->info('No orders in processing status.');
            return;
        }

        foreach ($processingOrders as $order) {
            $order->delivery_status = 'delivered';
            $order->payment_status = 'paid';
            $order->save();
        }

        $this->info('All processing orders changed to delivered.');
    }
}
