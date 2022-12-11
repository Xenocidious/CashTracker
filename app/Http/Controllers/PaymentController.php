<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Group;

class PaymentController extends Controller
{
    public function create($group_id)
    {
        $attributes = request()->validate([
            'title' => 'required|min:3|max:20',
            'amount' => 'required|numeric|max:1000000'
        ]);

        $attributes['group_id'] = $group_id;
        $attributes['user_id'] = auth()->user()->id;

        Payment::create($attributes);

        return redirect('group/'.$group_id);
    }

    public function edit($id)
    {
        $payment = Payment::find($id);

        return view('payments.edit', ['payment' => $payment]);
    }

    public function update($id)
    {
        $attributes = request()->validate([
            'title' => 'required|min:3|max:20',
            'amount' => 'required|numeric|max:1000000'
        ]);

        $payment = Payment::find($id);
        $payment->update($attributes);

        return redirect('group/'.$payment->group_id);
    }

    public function delete($id)
    {
        Payment::find($id)->delete();

        return back();
    }
}