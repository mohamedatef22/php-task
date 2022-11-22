@extends('Dashboard.index')

@section('content')
    <div class="my-5">
        <div>
            @if (session()->has('message'))
                @if (session()->get('success'))
                    <div class="mt-3 alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            @endif
            @if ($customer->myEmployee)
                <div class="mb-4 fs-5">
                    Assigned Employee : <span class="text-bold text-success"> {{ $customer->myEmployee->name }} </span>
                </div>
            @else
                <form action="{{ route('customer.assign', ['customer' => $customer->id]) }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="employee_id" class="col-form-label fs-5">Assign Employee : </label>
                        </div>
                        <div class="col-auto">
                            <select class="form-select" required id="employee_id" name="employee_id">
                                <option selected disabled value="">Select Employee</option>
                                @foreach ($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary">Assign</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
        @can('can-add-action', $customer)
            <form action="{{ route('action.add', ['customer' => $customer->id]) }}" method="POST">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="mb-3">
                        <label for="email" class="form-label">Action</label>
                        <select class="form-select" required id="employee_id" name="action">
                            <option selected disabled value="">Select Action</option>
                            <option value="call">call</option>
                            <option value="visit">visit</option>
                            <option value="follow_up">follow_up</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Result</label>
                        <textarea type="text" name="result" class="form-control" id="name" placeholder="Name" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        @endcan
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Action</th>
                        <th scope="col">Result</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($customer->customerActions as $action)
                        <tr>
                            <td>{{ $action->action }}</td>
                            <td>{{ $action->result }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
