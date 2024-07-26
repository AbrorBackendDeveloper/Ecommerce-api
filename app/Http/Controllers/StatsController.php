<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\DeliveryMethod;
use Illuminate\Support\Carbon;
use Illuminate\Support\LazyCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controllers\HasMiddleware;

class StatsController extends Controller implements HasMiddleware
{
    
    public static function middleware()
    {
        return [
            'auth:sanctum'
        ];
    }

    // Count the number of orders that between given times. default 1month
    public function ordersCount(Request $request)
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        if($request->has(['from', 'to'])){
            $from = $request->from;
            $to = $request->to;
        }
        
        return $this->response(
            Order::query()
                ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
                ->whereRelation('status', 'code', 'closed')
                ->count()); // har doim bazada statistikaolib kelayotganda agregat funksiya yordamida avval hisoblab keyin opkelamiz xudddi bu yerdagi count kabi get ishlatmasdan
    }
    
    
    //Sum of orders that between given times. default 1month
    public function ordersSalesSum(Request $request)
    {

        $from = Carbon::now()->subMonth();
        $to = Carbon::now();

        if($request->has(['from', 'to'])){
            $from = $request->from;
            $to = $request->to;
        }

        return $this->response(
            Order::query()
                ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
                ->whereRelation('status', 'code', 'closed')
                ->sum('sum')
            );
    }

    
    public function DeliveryMethodRatio(Request $request)
    {
        
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();
        $response = [];

        if($request->has(['from', 'to'])){
            $from = $request->from;
            $to = $request->to;
        }

        $allOrders = Order::query()
        ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
        ->whereRelation('status', 'code', 'closed')
        ->count();

        foreach(DeliveryMethod::all() as $deliveryMethod) {
            $deliveryMethodOrders = $deliveryMethod->orders()
            ->whereBetween('created_at', [$from, Carbon::parse($to)->endOfDay()])
            ->whereRelation('status', 'code', 'closed')
            ->count();

            $response[] = [
                'name' => $deliveryMethod->getTranslations('name'),
                'persentage' => number_format($deliveryMethodOrders * 100 / $allOrders, 2),
                'amount' => $deliveryMethodOrders
            ];
        }

        return $this->response($response);

    }



    public function OrdersCountByDays(Request $request)
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();
        $response = [];

        if($request->has(['from', 'to'])){
            $from = $request->from;
            $to = $request->to;
        }

        $days = CarbonPeriod::create($from, $to);
        $response = new Collection;

        LazyCollection::make($days->toArray())->each(function($day) use ($from, $to, $response){
            $count = Order::query()
            ->where('created_at', $day)
            ->whereRelation('status', 'code', 'closed')
            ->count();

            $response[] = [
                'date' => $day->format('Y-m-d'),
                'orders_count' => $count
            ];
        });
        
        return $this->response($response);
    }
}
