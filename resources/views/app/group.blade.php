@include('layouts.app')
@include('layouts.nav')

<div class="controlBar">
    <a href="/home" class="controlButton">Return Home</a>
    <a class="controlButton" onclick="expenseCreate()">Create a new expense</a>
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
            <h3>Click on a person to see their expenses, or click 
                <span class="underline" onclick="showExpenses('Collection')">here</span> to see all expenses.
            </h3>
            @foreach ($members as $member)
                @if ($expenses[$member->id]['total'])
                <li class="underline" onclick="showExpenses({{ $member->id }}), {{ $displayMember = $member->id }}">{{ $member->username }} has paid a total of ${{ $expenses[$member->id]['total'] }}</li>
                @else
                <li>{{ $member->username }} has not made any expenses</li>
                @endif
            @endforeach
        </div>

        <div id="expenseCollection" hidden>
            <span class="backButton" onclick="closeExpense('Collection')">Back</span>
            @foreach ($members as $member)
                @if ($expenses[$member->id]['total'] !== 0)
                    <div class="collectionUser">
                            <li class="expenseUsername">{{ $member->username }}</li>
                        @foreach ($expenses[$member->id] as $expense)
                            @if (is_object($expense))
                                <li>{{ $expense->title }}: <span class="expenseAmounts">${{ $expense->amount }}</span></li>
                            @endif
                        @endforeach
                        @if ($expense !== 0)
                            <li class="totalUserExpense">Total: ${{ $expense }}</li>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>

        @foreach ($members as $member)
            <div id="expense{{ $member->id }}" hidden>
                <span class="backButton" onclick="closeExpense({{ $member->id }})">Back</span>
                <li class="expenseUsername">{{ $member->username }}</li>
                @foreach ($expenses[$member->id] as $expense)
                    @if (is_object($expense))
                        <li>{{ $expense->title }}: <span class="expenseAmounts">${{ $expense->amount }} </span></li>
                        <div class="expenseChange">
                            <a href="/expense/edit/{{ $expense->id }}" id="expenseEdit" class="underline">Edit</a> 
                            <a href="/expense/delete/{{ $expense->id }}" id="expenseDelete" class="underline">Delete</a>
                        </div>
                    @else 
                        <li class="totalUserExpense">Total: ${{ $expense }}</li>
                    @endif
                @endforeach
            </div>
        @endforeach
    </ul>
</div>

<div id="popupContainer" class="groupPopup" hidden>
    @include('expenses.create')
</div>