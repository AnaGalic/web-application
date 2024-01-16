@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">Cities</div>
                        <div class="col-md-6"><a class="btn btn-primary float-end" href="{{ route('admin.city.create') }}">Add city</a></div>
                    </div>
                </div>

                <div class="card-body">
                    @foreach($cities as $city)
                        <p>{{ $city->name }}</p>

                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
