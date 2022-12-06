@extends('layouts.app')
<div class="navBar col">
    <form method="POST" action="/logout">
        @csrf
        <span class="username">{{ auth()->user()->username }}</span>
        <button class="logoutButton" type="submit">Log Out</button>
    </form>
</div>