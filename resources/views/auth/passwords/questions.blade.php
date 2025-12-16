@extends('layouts.blank2')

@section('content')
<div class="min-vh-100 w-100 d-flex align-items-center justify-content-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h5>Recover Password</h5>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.questions.verify') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>

                        {{-- Security Question --}}
                        <div class="form-group">
                            <label for="security_question">Security Question</label>
                            <select
                                class="form-control"
                                id="security_question"
                                name="security_question"
                                required
                            >
                                <option value="" disabled selected>
                                    -- Select your question --
                                </option>

                                <option value="pet_name">What was the name of your first pet?</option>
                                <option value="birth_city">In which city were you born?</option>
                                <option value="favorite_teacher">What is the name of your favorite teacher?</option>
                                <option value="first_school">What was the name of your first school?</option>
                                <option value="favorite_food">What is your favorite food?</option>
                            </select>
                        </div>

                        {{-- Answer --}}
                        <div class="form-group">
                            <label for="answer">Your Answer</label>
                            <input
                                type="text"
                                class="form-control"
                                id="answer"
                                name="answer"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            Verify Answer
                        </button>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ route('login') }}">Back to login</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
