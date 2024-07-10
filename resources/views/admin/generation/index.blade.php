@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-header">
                    <h3>User Generation Level</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('generation.set')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label> @lang('Commission Type')</label>
                                    <input class="form-control" type="text" name="commission_type" required value="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Level')</label>
                                    <input class="form-control" id="text_inp" onclick="addReadonly()" name="level" required value="{{@$levels}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Amount')</label>
                                    <input class="form-control" type="number" name="percent" required value="percent">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-5">

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Commission Type</th>
                    <th scope="col">Level</th>
                    <th scope="col">Percent</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($refs as $ref)
                <tr>
                    <td>{{$ref->commission_type}}</td>
                    <td>{{$ref->level}}</td>
                    <td>{{$ref->percent}}%</td>
                    <td><a href="{{ url('admin/level/edit/') }}/{{ $ref->id }}" class="btn btn-primary">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="from-control text-center mt-3">
            <a href="{{route('generation.delete')}}" class="btn btn-danger">Delete</a>
        </div>
    </div>
</div>
@endsection