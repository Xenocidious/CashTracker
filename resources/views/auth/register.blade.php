@extends('layouts.app')
<div class="authContainer">
    <div>
        <a href="#"><button class="signupButton active">Sign Up</button></a>
        <a href="/login"><button class="signinButton">Sign In</button></a>
    </div>
    <form method="POST" action="/register">
        @csrf

        <div class="formItem">
            <label>Username</label>
            <input name="username" type="text" value="{{ old('username') }}" required />
            @error('username')
                <p class="error">{{ $message }}<p>
            @enderror
        </div>

        <div class="formItem">
            <label>Email address</label>
            <input name="email" type="email" value="{{ old('email') }}" required />
            @error('email')
                <p class="error">{{ $message }}<p>
            @enderror
        </div>

        <div class="formItem">
            <label>Password</label>
            <input name="password" type="password" required />
            @error('password')
                <p class="error">{{ $message }}<p>
            @enderror
        </div>

        <div class="formItem">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>
