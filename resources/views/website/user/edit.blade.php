@extends('layouts.app')
@section('meta-details')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Edit ') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('user.update',$user->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name"value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('legal_name') is-invalid @enderror"
                                    id="exampleInputEmail1" name="email" value="{{ $user->email }}" required>
                                @error('email')
                                    <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone_no') is-invalid @enderror"
                                    id="phoneNumber" name="phone_no"value="{{ $user->phone_no }}" required>
                                @error('phone_no')
                                    <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Department</label>
                                <select class="form-select @error('department_id') is-invalid @enderror"
                                     name="department_id" required>
                                    <option selected>Select Department</option>
                                    <option value="1" {{ $user->department_id == 1 ? 'selected' : '' }}>HR</option>
                                    <option value="2" {{ $user->department_id == 2 ? 'selected' : '' }}>Software
                                    </option>
                                    <option value="3" {{ $user->department_id == 3 ? 'selected' : '' }}>IT</option>
                                </select>
                                @error('department_id')
                                    <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputrole" class="form-label">Role</label>
                                <select class="form-select @error('role_id') is-invalid @enderror"
                                     name="role_id" required>
                                    <option selected>Select Role</option>
                                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Agent</option>
                                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Supervisor</option>
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback animated fadeIn">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
@endsection
