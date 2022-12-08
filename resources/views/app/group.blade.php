@include('layouts.app')
@include('layouts.nav')

<div class="controlBar">
    <a href="/home" class="controlButton">Return Home</a>
    <a class="controlButton" onclick="paymentCreate()">Create a new payment</a>
    @if ($group->invite_code)
        <a id="inviteCode" class="controlButton inviteTooltip" onclick="copyInviteCode('{{ $group->invite_code }}')" onmouseout="outFunc()">
            <span class="inviteTooltipText" id="myTooltip">Copy to clipboard</span>
            Invite code: {{ $group->invite_code }}
        </a>
    @endif
    <a href="{{ $group->id }}/generateInvite" class="controlButton">Generate new invite code</a>
</div>
<div class="container">
    <ul class="list"> 
        <div id="groupMain">
            <h3>Click on a person to see their payments, or click <span class="underline" onclick="showPayments('Total')">here</span> to see all purchases.</h3>
            @foreach ($members as $member)
                @if ($payments[$member->id]['total'])
                <li class="underline" onclick="showPayments({{ $member->id }}), {{ $displayMember = $member->id }}">{{ $member->username }} has paid a total of ${{ $payments[$member->id]['total'] }}</li>
                @else
                <li>{{ $member->username }} has not made any payments</li>
                @endif
            @endforeach
        </div>

        <div id="paymentTotal" hidden>
            <span class="backButton" onclick="closePayment('Total')">Back</span>
            <li class="paymentUsername">{{ $member->username }}</li>
            @foreach ($payments[$member->id] as $payment)
                @if (is_object($payment))
                    <li>{{ $payment->title }}: ${{ $payment->amount }}</li>
                @else 
                    <li class="totalPayment">Total: ${{ $payment }}</li>
                @endif
            @endforeach
        </div>

        @foreach ($members as $member)
            <div id="payment{{ $member->id }}" hidden>
                <span class="backButton" onclick="closePayment({{ $member->id }})">Back</span>
                <li class="paymentUsername">{{ $member->username }}</li>
                @foreach ($payments[$member->id] as $payment)
                    @if (is_object($payment))
                        <li>{{ $payment->title }}: ${{ $payment->amount }}</li>
                    @else 
                        <li class="totalPayment">Total: ${{ $payment }}</li>
                    @endif
                @endforeach
            </div>
        @endforeach
    </ul>
</div>

<div id="popupContainer" class="groupPopup" hidden>
    @include('app.paymentForm')
</div>