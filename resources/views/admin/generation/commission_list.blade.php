@extends('backend.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card py-4 m-2">
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">SL.</th>
                                <th scope="col">Taken User</th>
                                <th scope="col">Given User</th>
                                <th scope="col">Level</th>
                                <th scope="col">Post Balance</th>
                                <th scope="col">Commission Amount</th>
                                <th scope="col">Club Point</th>
                                <th scope="col">Title</th>
                                <th scope="col">Type</th>
                                <th scope="col">Percent</th>
                                <th scope="col">TRX</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commissions as $ref)
                            <tr>
                                <td>{{ $ref->id}}</td>
                                <td>{{ $ref->toUser->email }}</td>
                                <td>{{ $ref->fromUser->email }}</td>
                                <td>{{$ref->level}}</td>
                                <td>{{$ref->post_balance}}</td>
                                <td>{{$ref->commission_amount}}</td>
                                <td>{{$ref->trx_amo}}</td>
                                <td>{{$ref->title}}</td>
                                <td>{{$ref->type}}</td>
                                <td>{{$ref->percent}}%</td>
                                <td>{{$ref->trx}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($commissions->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($commissions) }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection