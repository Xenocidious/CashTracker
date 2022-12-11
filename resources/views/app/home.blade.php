@include('layouts.app')
@include('layouts.nav')

<div class="container">
    @if ($groups)
        @foreach ($groups as $group)
            <a href="group/{{ $group->id }}" class="group">
                <h2>{{ $group->name }}</h2>
                <h3>By {{ $group->owner }}</h3>
            </a>
        @endforeach
    @endif
    <div class="group formGroup">
        <form method="POST" action="/group/create">
            @csrf
            <h5>Make a new group</h5>

            <div class="groupFormItem">
                <label class="groupFormLabel">Group name</label>
                <input type="submit" name="submit" value="Create">
                <input type="text" name="name">
            </div>
        </form>
        <form method="POST" action="group/join">
            @csrf
            <h5>Or join an existing one</h5>

            <div class="groupFormItem">
                <label class="groupFormLabel">Invite Code</label>
                <input type="submit" name="submit" value="Join">
                <input type="text" name="invite_code">
            </div>
        </form>
        @if ($errors->any())
            <ul class="ulMakeGroup">
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>