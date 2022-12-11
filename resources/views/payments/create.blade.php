<div id="paymentForm" class="popupChild">
    <form method="POST" action="/payment/create/{{ $group->id }}">
        @csrf
        <span class="closeButton" onclick="paymentCreate()">Close</span>
        <h5>Make a new payment</h5>

        <div class="groupFormItem">
            <label class="groupFormLabel">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" />
        </div>
        <div class="groupFormItem">
            <label class="groupFormLabel">Amount</label>
            <input type="number" name="amount" value="{{ old('amount') }}" step=".01" />
        </div>
        <div class="groupFormItem">
            <input type="submit" name="submit" value="Create">
        </div>
    </form>
    @if ($errors->any())
    <!-- Re-opens the popup form and displays errors -->
        <script>
            document.getElementById("popupContainer").hidden = false
            document.getElementById("paymentForm").hidden = false
        </script>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>