@include('layouts.app')
@include('layouts.nav')

<div id="expenseEditForm" class="popupChild">
    <form method="POST" action="/expense/update/{{ $expense->id }}">
        @csrf
        <h5>Edit your expense</h5>

        <div class="groupFormItem">
            <label class="groupFormLabel">Title</label>
            <input type="text" name="title" placeholder="{{ $expense->title }}" />
        </div>
        <div class="groupFormItem">
            <label class="groupFormLabel">Amount</label>
            <input type="number" name="amount" step=".01" placeholder="{{ $expense->amount }}" />
        </div>
        <div class="groupFormItem">
            <input type="submit" name="submit" value="Update">
        </div>
    </form>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>