@extends('layouts.blank2')

@section('content')
    <div class="min-vh-100 w-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header text-center">
                            <h5>Reset Password</h5>
                        </div>

                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.questions.update', $userId) }}">
                                @csrf

                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-success btn-block">
                                    Reset Password
                                </button>
                            </form>
                        </div>

                        <div class="card-footer text-center">
                            <small>Password must be at least 8 characters</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
