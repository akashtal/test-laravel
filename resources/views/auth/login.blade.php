@extends('layouts.app')

@section('title', 'Login - Employee Management System')

@section('content')
<div style="max-width: 400px; margin: 5rem auto;">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Login</h2>
        </div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="login" class="form-label">Username or Phone Number</label>
                <input type="text" 
                       id="login" 
                       name="login" 
                       class="form-control @error('login') is-invalid @enderror" 
                       value="{{ old('login') }}" 
                       placeholder="Enter your username or phone number"
                       required 
                       autofocus>
                @error('login')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </form>

        <div style="text-align: center; margin-top: 1rem;">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>
</div>
@endsection
