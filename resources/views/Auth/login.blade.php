@extends('Layout.layout')

@section('head')
    <link rel="stylesheet" href="css/login.css">
@endsection

@section('body')
    <div class="bg-dark bg-gradient main-div">
        <div class="bg-light bg-gradient mx-5 login-box d-flex align-items-center justify-content-center">
            <div class="my-5">
                <h1 class="mb-5 text-center">Welcome Back</h1>

                @error('email')
                    <div class="text-danger mb-2">
                        <ul>
                            <li>
                                {{ $message }}  
                            </li>
                        </ul>
                    </div>
                @enderror

                <form class="d-flex flex-column" action="{{ route('auth') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
