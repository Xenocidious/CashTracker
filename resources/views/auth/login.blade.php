@extends('layouts.app')
<div class="authContainer">
    <div>
        <a href="/register"><button class="signupButton">Sign Up</button></a>
        <a href="#"><button class="signinButton active">Sign In</button></a>
    </div>
    <form method="POST" action="/login">
        @csrf

        <div class="formItem">
            <label>Username</label>
            <input name="username" type="text" required />
            @error('username')
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
            <input type="submit" name="formSubmit" value="Submit">
        </div>
    </form>
</div>
