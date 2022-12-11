<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\Group;

class ExpenseController extends Controller
{
    public function create($group_id)
    {
        $attributes = request()->validate([
            'title' => 'required|min:3|max:20',
            'amount' => 'required|numeric|max:1000000'
        ]);

        $attributes['group_id'] = $group_id;
        $attributes['user_id'] = auth()->user()->id;

        Expense::create($attributes);

        return redirect('group/'.$group_id);
    }

    public function edit($id)
    {
        $expense = Expense::find($id);

        return view('expenses.edit', ['expense' => $expense]);
    }

    public function update($id)
    {
        $attributes = request()->validate([
            'title' => 'nullable|min:3|max:20',
            'amount' => 'nullable|numeric|max:1000000'
        ]);

        $expense = Expense::find($id);
        if (!isset($attributes['title'])) {
            $attributes['title'] = $expense->title;
        }
        if (!isset($attributes['amount'])) {
            $attributes['amount'] = $expense->amount;
        }   

        $expense->update($attributes);

        return redirect('group/'.$expense->group_id);
    }

    public function delete($id)
    {
        Expense::find($id)->delete();

        return back();
    }
}