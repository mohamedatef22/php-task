@extends('Dashboard.index')

@section('content')
    <div class="my-5">
        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                    value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                    value="{{ old('name') }}" required>
            </div>

            @can('add-employee')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Assign Emplyee</label>
                    <select class="form-select" aria-label="Default select example" name="employee_id">
                        <option {{!old('employee_id') ? 'selected':''}} value="0">Select Employee</option>
                        @foreach ($employees as $emp)
                            <option {{old('employee_id') == $emp->id ? 'selected':''}} value="{{ $emp->id }}">{{ $emp->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">Note it is not required to add employee now</span>
                </div>
            @endcan

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
