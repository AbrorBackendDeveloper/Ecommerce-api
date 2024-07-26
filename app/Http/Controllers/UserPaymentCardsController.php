<?php

namespace App\Http\Controllers;

use PaymentCardRepository;
use App\Models\UserPaymentCards;
use App\Http\Resources\UserPaymentCardResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\StoreUserPaymentCardsRequest;
use App\Http\Requests\UpdateUserPaymentCardsRequest;

class UserPaymentCardsController extends Controller implements HasMiddleware
{

    protected PaymentCardRepository $paymentCardRepository;
    
    public static function middleware()
    {
        return [
            'auth:sanctum'
        ];
    }

    public function __construct()
    {
        $this->paymentCardRepository = app(PaymentCardRepository::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->response(UserPaymentCardResource::collection(auth()->user()->payment_cards));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserPaymentCardsRequest $request)
    {
        $this->paymentCardRepository->savePaymentCard($request);

        return $this->success('card added');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPaymentCards $userPaymentCards)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPaymentCards $userPaymentCards)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserPaymentCardsRequest $request, UserPaymentCards $userPaymentCards)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPaymentCards $userPaymentCards)
    {
        //
    }
}
