<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\Order;

class ProductionSchedulerService
{
    public function schedule(Collection $groupedOrders): array
    {
        $schedule = [];
        $startProductionDate = $this->determineStartProductionDate($groupedOrders);

        foreach ($groupedOrders as $ordersByType) {
            $endProductionDate = $this->processOrders($ordersByType, $schedule, $startProductionDate);
            $startProductionDate = $endProductionDate->copy()->addMinutes(30);
        }

        return $schedule;
    }

    private function determineStartProductionDate(Collection $groupedOrders): Carbon
    {
        return $groupedOrders->first()?->first()->start_production_date ? Carbon::parse($groupedOrders->first()->first()->start_production_date) : Carbon::now();
    }

    private function processOrders(Collection $orders, array &$schedule, Carbon $startProductionDate): Carbon
    {
        foreach ($orders as $order) {
            $productionTimeInHours = $this->calculateProductionTime($order);
            $endProductionDate = $startProductionDate->copy()->addHours($productionTimeInHours);

            $this->persistScheduleEntry($order, $startProductionDate, $endProductionDate);
            $this->addToSchedule($order, $schedule, $productionTimeInHours, $startProductionDate, $endProductionDate);

            $startProductionDate = $endProductionDate->copy();
        }

        return $startProductionDate;
    }
    
    private function calculateProductionTime(Order $order): float
    {
        $totalQuantity = $order->orderItems()->sum('quantity');
        $productType = $order->orderItems()->first()->product->type;

        return round($totalQuantity / config("product-types.$productType.units-per-hour") * 2) / 2;
    }

    private function addToSchedule(Order $order, array &$schedule, float $productionTimeInHours): void
    {
        $schedule[] = [
            'order_id' => $order->id,
            'start_time' => $order->start_production_date,
            'end_time' => $order->end_production_date,
            'hours' => $this->formatProductionTime($productionTimeInHours),
            'need_by_date' => $order->need_by_date,
            'prevision' => $this->calculatePrevision($order->end_production_date, $order->need_by_date),
            'type' => $order->orderItems->first()->product->type
        ];
    }

    private function formatProductionTime(float $productionTimeInHours): string
    {
        $hours = floor($productionTimeInHours);
        $minutes = ($productionTimeInHours - $hours) * 60;
    
        return "{$hours}h" . ($minutes > 0 ? "{$minutes}m" : '');
    }
    
    private function calculatePrevision(Carbon $endTime, string $needByDate): string
    {
        $difference = round($endTime->diffInHours($needByDate) * 2) / 2;
    
        return $difference < 0 ? 'Late by ' . abs($difference) . ' hours' :
               ($difference > 0 ? 'Early by ' . $difference . ' hours' : 'On time');
    }

    private function persistScheduleEntry(Order $order, Carbon $startTime, Carbon $endTime): void
    {
        if (!$order->start_production_datetime?->eq($startTime)) {
            $order->update([
                'start_production_date' => $startTime,
                'end_production_date' => $endTime,
            ]);
        }
    }
}