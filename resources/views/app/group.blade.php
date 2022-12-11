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
            <h3>Click on a person to see their payments, or click <span class="underline" onclick="showPayments('Collection')">here</span> to see all payments.</h3>
            @foreach ($members as $member)
                @if ($payments[$member->id]['total'])
                <li class="underline" onclick="showPayments({{ $member->id }}), {{ $displayMember = $member->id }}">{{ $member->username }} has paid a total of ${{ $payments[$member->id]['total'] }}</li>
                @else
                <li>{{ $member->username }} has not made any payments</li>
                @endif
            @endforeach
        </div>

        <div id="paymentCollection" hidden>
            <span class="backButton" onclick="closePayment('Collection')">Back</span>
            @foreach ($members as $member)
                @if ($payments[$member->id]['total'] !== 0)
                    <div class="collectionUser">
                            <li class="paymentUsername">{{ $member->username }}</li>
                        @foreach ($payments[$member->id] as $payment)
                            @if (is_object($payment))
                                <li>{{ $payment->title }}: <span class="paymentAmounts">${{ $payment->amount }}</span></li>
                            @endif
                        @endforeach
                        @if ($payment !== 0)
                            <li class="totalUserPayment">Total: ${{ $payment }}</li>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>

        @foreach ($members as $member)
            <div id="payment{{ $member->id }}" hidden>
                <span class="backButton" onclick="closePayment({{ $member->id }})">Back</span>
                <li class="paymentUsername">{{ $member->username }}</li>
                @foreach ($payments[$member->id] as $payment)
                    @if (is_object($payment))
                        <li>{{ $payment->title }}: <span class="paymentAmounts">${{ $payment->amount }} </span></li>
                        <div class="paymentChange">
                            <a href="/payment/edit/{{ $payment->id }}" id="paymentEdit" class="underline">Edit</a> 
                            <a href="/payment/delete/{{ $payment->id }}" id="paymentDelete" class="underline">Delete</a>
                        </div>
                    @else 
                        <li class="totalUserPayment">Total: ${{ $payment }}</li>
                    @endif
                @endforeach
            </div>
        @endforeach
    </ul>
</div>

<div id="popupContainer" class="groupPopup" hidden>
    @include('payments.create')
</div>