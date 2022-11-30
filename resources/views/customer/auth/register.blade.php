<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
