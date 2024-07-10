@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('generation.update')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <input class="form-control" type="hidden" name="id" required value="{{$ref->id}}">
                                <div class="form-group ">
                                    <label> @lang('Commission Type')</label>
                                    <input class="form-control" type="text" name="commission_type" required value="{{$ref->commission_type}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Level')</label>
                                    <input class="form-control" type="text" name="level" required value="{{$ref->level}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Percent')</label>
                                    <input class="form-control" type="text" name="percent" required value="{{$ref->percent}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection