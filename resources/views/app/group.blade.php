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
        <h3>Hover on a user to see their payments, or click <a href="" class="showPurchases">here</a> to see all purchases.</h3>
        @foreach ($members as $member)
            @if ($payments[$member->id]['total'])
            <li class="">{{ $member->username }} has paid a total of ${{ $payments[$member->id]['total'] }} : hover = show payments</li>
            @else
            <li class="">{{ $member->username }} has not made any payments</li>
            @endif
        @endforeach
    </ul>
</div>

<div id="popupContainer" class="groupPopup" hidden>
    @include('app.paymentForm')
</div>