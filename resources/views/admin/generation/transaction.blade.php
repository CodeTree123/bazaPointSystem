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
                                <th scope="col">User Email Address</th>
                                <th scope="col">Details</th>
                                <th scope="col">New Balance</th>
                                <th scope="col">Commission Amount</th>
                                <th scope="col">Trnsaction Number</th>
                                <th scope="col">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($generations as $ref)
                            <tr>
                                <td>{{ $ref->id}}</td>
                                <td>{{ $ref->user->email }}</td>
                                <td>{{ $ref->details }}</td>
                                <td>{{$ref->post_balance}}</td>
                                <td>{{$ref->trx_type}}{{$ref->amount}}</td>
                                <td>{{$ref->trx}}</td>
                                <td>{{$ref->remark}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($generations->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($generations) }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection