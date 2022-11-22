@extends('Dashboard.index')

@section('content')
    <div class="my-5">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Employee Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                    <td class=" {{!$customer->myEmployee ? 'text-danger':''}}">{{$customer->myEmployee ? $customer->myEmployee->name : "Not Assign" }}</td>
                    <td><a href="{{ route('customer.show', ['customer'=>$customer->id]) }}" class="btn btn-primary btn-sm"><span data-feather="eye"></span></button></td>
                  </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
    </div>
@endsection
