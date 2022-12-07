<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function create($id)
    {
        $attributes = request()->validate([
            'title' => 'required|min:3|max:20',
            'amount' => 'required'
        ]);

        $attributes['group_id'] = $id;
        $attributes['user_id'] = auth()->user()->id;

        Payment::create($attributes);

        return redirect('group/'.$id);
    }

    public function edit()
    {
        
    }

    public function delete()
    {
        
    }
}