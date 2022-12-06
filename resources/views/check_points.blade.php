@extends('layouts.app')

@section('page_title', 'Check Points')

@section('content')
    <div class="container mt-3">
        @if(!isset($customer))
            <form>
                <div class="mb-3">
                    <label for="member_id" class="form-label">Customer ID / Phone</label>
                    <input type="text" class="form-control" placeholder="9000xxxxxxxxxxxx or 08xxxxxxxxxx"
                           id="member_id"
                           name="member_id" autofocus>
                </div>
                <button type="submit" class="btn btn-primary">Check Points</button>
            </form>
        @else
            <div class="row">
                <div class="col-md-6">
                    <h1>
                        Hi, {{ $customer->name }}!
                    </h1>
                    <small>
                        Member ID:{{ $customer->member_id }}
                        <a href="{{ route('check_points') }}" class="text-danger">
                            X
                        </a>
                    </small>
                </div>
                <div class="col-md-6">
                    <table class="table table-hover table-bordered table-sm mt-3 mt-md-0">
                        <tbody>
                        <tr>
                            <th>Level</th>
                            <td>{{ optional(optional($customer->badges)->last())->name }}</td>
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
                </div>
            </div>
            <table class="table table-hover table-bordered table-sm table-striped mt-3">
                <thead>
                <tr>
                    <th>Action</th>
                    <th>Points</th>
                    <th>Given At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customer->reputations->reverse() as $reputation)
                    <tr>
                        <td>
                            {{ $reputation->name }}
                            @if(json_decode($reputation->meta))
                                <dl class="mb-0 text-muted" style="font-size: 60%;">
                                    @foreach(json_decode($reputation->meta) as $key => $value)
                                        @continue($key != 'transaction_id')
                                        <dt>{{ 'Transaction ID' }}</dt>
                                        <dd>{{ $value }}</dd>
                                    @endforeach
                                </dl>
                            @endif
                        </td>
                        <td>{{ $reputation->point }}</td>
                        <td>{{ $reputation->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
