@extends('layouts.app')

@section('page_title', 'Loyalty App')

@section('content')
    <div class="container mt-3">
        <div class="row">
            @isset($customer)
                <div class="col-md-6 order-md-4">
                    <table class="table table-hover table-bordered table-sm table-striped">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Points</th>
                            <th>Meta</th>
                            <th>Given At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer->reputations->reverse() as $reputation)
                            <tr>
                                <td>
                                    {{ $reputation->name }}
                                </td>
                                <td>{{ $reputation->point }}</td>
                                <td>
                                    @if(json_decode($reputation->meta))
                                        <dl class="mb-0">
                                            @foreach(json_decode($reputation->meta) as $key => $value)
                                                <dt>{{ $key }}</dt>
                                                <dd>{{ $value }}</dd>
                                            @endforeach
                                        </dl>
                                    @endif
                                </td>
                                <td>{{ $reputation->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endisset
            <div class="col-md-6 order-md-3">
                @isset($customer)
                    <form method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="member_id" class="form-label">Customer ID</label>
                            <div class="input-group">
                                <input type="text" class="form-control disabled" placeholder="9000xxxxxxxxxxxx" id="member_id"
                                       name="member_id" value="{{ request('member_id') }}" readonly disabled>
                                <a class="btn btn-outline-danger" href="/loyalty">Cancel</a>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered table-sm">
                            <tbody>
                            <tr>
                                <th>Member ID</th>
                                <td>{{ $customer->member_id }}</td>
                            </tr>
                            <tr>
                                <th>Level</th>
                                <td>{{ $customer->badges->last()->name }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $customer->name }}</td>
                            </tr>
                            <tr>
                                <th>Points</th>
                                <td>{{ $customer->getPoints() }}</td>
                            </tr>
                            <tr>
                                <th>Tea Leaves</th>
                                <td>{{ $customer->balance }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Purchase Amount</label>
                            <input type="number" class="form-control" id="amount" autofocus name="amount">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @else
                    <form>
                        <div class="mb-3">
                            <label for="member_id" class="form-label">Customer ID</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="9000xxxxxxxxxxxx" id="member_id"
                                       name="member_id" autofocus>
                                <button class="btn btn-outline-secondary" type="submit">Load Customer</button>
                            </div>
                        </div>
                        <fieldset disabled>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Purchase Amount</label>
                                <input type="number" class="form-control" id="amount">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </fieldset>
                    </form>
                @endisset
            </div>
        </div>
    </div>
@endsection
