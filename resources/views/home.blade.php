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
                    <div class="card-header">{{ __('User List') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('employee.search') }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ @$name }}" placeholder="Name">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="emp_id"
                                                value="{{ @$emp_id }}" placeholder="EmpId">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Search</button>
                                    <a href="{{ route('home')}}"
                                    class="btn btn-outline-primary mt-2" style="margin-left:10px">Clear</a>
                                </form>
                                <a href="{{ route('employee.email')}}"
                                class="btn btn-outline-secondary mt-2" style="margin-left:10px">Send</a>
                                <hr/>
                                @if ($query_string != null)
                                    <div class="btn-group mt-2" role="group">
                                        <a href="{{ route('employee.export') . '?' . $query_string }}"
                                            class="btn btn-primary">Export</a>  
                                      
                                        <a href="{{ route('user.create') }}" class="btn btn-md btn-info"
                                            style="margin-left:10px">Create</a>
                                    </div>
                                @else
                                    <div class="btn-group mt-2" role="group">
                                        <a href="{{ route('employee.export') }}" class="btn btn-outline-primary">Export</a>
                                        <a href="{{ route('user.create') }}" class="btn btn-md btn-info"
                                            style="margin-left:10px">Create</a>
                                    </div>
                                @endif

                            </div>

                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Emp Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $user->emp_id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->department }}</td>
                                        <td><a class="btn btn-outline-primary"
                                                href="{{ route('user.edit', $user->id) }}">Edit</a></td>
                                        <td> <a class="btn btn-outline-warning"
                                                href="{{ route('user.delete', $user->id) }}"
                                                onclick="return confirm('Are you sure to Delete?');"> Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-12 col-md-6 col-auto">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
@endsection
