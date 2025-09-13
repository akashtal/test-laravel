@extends('layouts.app')

@section('title', 'Edit Employee - Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Employee</h2>
    </div>
    
    <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $employee->name) }}" 
                   required>
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
                   value="{{ old('username', $employee->username) }}" 
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
                   value="{{ old('phone', $employee->phone) }}" 
                   required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">New Password (Leave blank to keep current password)</label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   class="form-control">
        </div>

        <div class="form-group">
            <label for="role" class="form-label">Role</label>
            <select id="role" 
                    name="role" 
                    class="form-control @error('role') is-invalid @enderror" 
                    required>
                <option value="Employee" {{ old('role', $employee->role) == 'Employee' ? 'selected' : '' }}>Employee</option>
                <option value="Admin" {{ old('role', $employee->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Employee</button>
        <a href="{{ route('admin.employees') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
