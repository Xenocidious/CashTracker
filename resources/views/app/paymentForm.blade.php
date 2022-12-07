<div id="paymentForm" class="popupChild">
    <form method="POST" action="/group/{{ $group->id }}/paymentCreate">
        @csrf
        <span class="closeButton" onclick="paymentCreate()">Close</span>
        <h5>Make a new payment</h5>

        <div class="groupFormItem">
            <label class="groupFormLabel">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required />
            @error('title')
                <p class="error">{{ $message }}<p>
            @enderror
        </div>
        <div class="groupFormItem">
            <label class="groupFormLabel">Amount</label>
            <input type="number" name="amount" value="{{ old('amount') }}" step=".01" required />
            @error('amount')
                <p class="error">{{ $message }}<p>
            @enderror
        </div>
        <div class="groupFormItem">
            <input type="submit" name="submit" value="Create">
        </div>
    </form>
</div>