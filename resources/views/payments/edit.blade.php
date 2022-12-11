@include('layouts.app')

<div id="paymentEditForm" class="popupChild">
    <form method="POST" action="/payment/update/{{ $payment->id }}">
        @csrf
        <h5>Edit your payment</h5>

        <div class="groupFormItem">
            <label class="groupFormLabel">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="{{ $payment->title }}" />
        </div>
        <div class="groupFormItem">
            <label class="groupFormLabel">Amount</label>
            <input type="number" name="amount" value="{{ old('amount') }}" step=".01" placeholder="{{ $payment->amount }}" />
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