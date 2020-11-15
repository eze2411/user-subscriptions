<?php

namespace App\Http\Controllers;

use App\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Show the list of Subscriptions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('subscription.list', ['subscriptions' => Subscription::all()]);
    }
}
