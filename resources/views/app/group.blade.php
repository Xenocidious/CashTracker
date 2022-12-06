@include('layouts.app')
@include('layouts.nav')

<div class="controlBar">
    <a href="/home" class="controlButton">Return Home</a>
    <a href="purchaseCreate" class="controlButton">Create a new purchase</a>
    <a id="inviteCode" class="controlButton">Invite code: {{ $group->invite_code }} : onclick] = copy</a>
    <a href="{{ $group->id }}/generateInvite" class="controlButton">Generate new invite code</a>
</div>
<div class="container">
    <ul class="list"> 
<?php
        foreach ($members as $member) {
?>
            <li>{{ $member->username }} has paid a total of <span>[$purchase->price : hover] = show purchases</span></li>
<?php
        }
?>
    </ul>

</div>