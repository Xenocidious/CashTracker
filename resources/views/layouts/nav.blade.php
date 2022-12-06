@extends('layouts.app')
<div class="navBar col">
    <span>{{ auth()->user()->username }}</span>
    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Log Out</button>
    </form>
</div>