@extends('layouts.app')

@section('page_title', 'Member Registration')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('register') }}" method="post">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">
                                Register
                            </h1>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="mb-3">
                                <x-forms.input name="name" autofocus required>
                                    Name
                                </x-forms.input>
                            </div>
                            <div class="mb-3">
                                <x-forms.input name="email" required>
                                    Email
                                </x-forms.input>
                            </div>
                            <div class="mb-3">
                                <x-forms.input name="password" type="password" required>
                                    Password
                                </x-forms.input>
                            </div>
                            <div class="mb-3">
                                <x-forms.input name="password_confirmation" type="password" required>
                                    Confirm Password
                                </x-forms.input>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
