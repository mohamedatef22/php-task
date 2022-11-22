@extends('Dashboard.index')

@section('content')
    <div class="my-5">
        <form action="{{ route('employee.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>

        @if ($errors->any())
            <div class="mt-3 alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('message'))
            @if (session()->get('success'))
                <div class="mt-3 alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        @endif
    </div>
@endsection
