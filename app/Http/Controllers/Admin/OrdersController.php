<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::current()->oldest()->paginate(10);

        return view('admin/orders/index', ['orders' => $orders]);
    }

    public function indexCompleted()
    {
        $orders = Order::history()->latest()->paginate(10);

        return view('admin/orders/completed', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        return view('admin/orders/show', ['order' => $order]);
    }
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin/orders/edit', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'weekday' => 'required|date',
            'hour' => 'required|min:1|max:24'
        ]);

        $date = \Carbon\Carbon::parse($request->input('weekday'));
        $date->hour = $request->input('hour');

        $order->update([
            'retrieval_at' => $date
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'La commande N°'. $order->id . ' a bien été éditée.');
    }
    
    public function inProgress(Order $order)
    {
        if ($order->in_progress) {
            $order->update([
                'in_progress' => false
            ]);

            return redirect()->route('admin.orders.show', $order)
                ->with(
                    'success', 
                    'Vous avez supprimé le status [En cours de préparation] de la commande n°'.$order->id
                );
        }

        $order->update([
            'in_progress' => true
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with(
                'success', 
                'Vous avez changé le status de la commande n°'.$order->id.' à [En cours de préparation].'
            );
    }

    public function isCompleted(Order $order)
    {
        if ($order->is_completed) {
            $order->update([
                'is_completed' => false
            ]);

            return redirect()->route('admin.orders.show', $order)
                ->with(
                    'success', 
                    'Vous avez supprimé le status [Terminer] de la commande n°'.$order->id
                );
        }

        $order->update([
            'is_completed' => true
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with(
                'success', 
                'Vous avez changé le status de la commande n°'.$order->id.' à [Terminer].'
            );
    }

    public function isReady(Order $order)
    {
        if ($order->is_ready) {
            $order->update([
                'is_ready' => false
            ]);

            return redirect()->route('admin.orders.show', $order)
                ->with(
                    'success', 
                    'Vous avez supprimé le status [Prêt] de la commande n°'.$order->id
                );
        }

        $order->update([
            'is_ready' => true
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with(
                'success', 
                'Vous avez changé le status de la commande n°'.$order->id.' à [Prêt].'
            );
    }   

    public function isCanceled(Order $order)
    {
        if ($order->is_canceled) {
            $order->update([
                'is_canceled' => false
            ]);

            return redirect()->route('admin.orders.show', $order)
                ->with(
                    'success', 
                    'Vous avez supprimé le status [Annuler] de la commande n°'.$order->id
                );
        }

        $order->update([
            'is_canceled' => true
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with(
                'success', 
                'Vous avez changé le status de la commande n°'.$order->id.' à [Annuler]'
            );
    }    
}
