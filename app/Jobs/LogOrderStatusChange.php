<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\OrderStatusLog;

class LogOrderStatusChange implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;
    protected $oldStatus;
    protected $newStatus;

    /**
     * Create a new job instance.
     */
    public function __construct($orderId, $oldStatus, $newStatus)
    {
        $this->orderId = $orderId;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        OrderStatusLog::create([
            'order_id' => $this->orderId,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus
        ]);
    }
}
