@extends('layouts.app')

@section('title', 'Register - Management')

@section('content')
<div style="max-width: 500px; margin: 3rem auto;">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Register as Admin</h2>
            <p style="color: #666; margin-top: 0.5rem;">You will be registered as an Admin by default</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       class="form-control @error('username') is-invalid @enderror" 
                       value="{{ old('username') }}" 
                       placeholder="Choose a unique username"
                       required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" 
                       id="phone" 
                       name="phone" 
                       class="form-control @error('phone') is-invalid @enderror" 
                       value="{{ old('phone') }}" 
                       required>
                @error('phone')
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

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="form-control" 
                       required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>
        </form>

        <div style="text-align: center; margin-top: 1rem;">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</div>
@endsection
