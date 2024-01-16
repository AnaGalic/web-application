@extends('layouts.admin.app')

@section('content')
<div class="container">
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="row my-2">
        <div class="col-md-6"><h3>Moji Stanovi</h3></div>
        <div class="col-md-6">
            <div class="text-end">
                <a class="btn btn-primary" href="{{ route('renter.apartment.create') }}">Dodaj novi stan</a>
            </div>
        </div>
    </div>

    <table class="table table-hover border">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Naslov</th>
            <th scope="col">Adresa</th>
            <th scope="col">Opcije</th>
        </tr>
        </thead>
        <tbody>
            @foreach($apartments as $apartment)
            <tr>
                <th scope="row">{{ $apartment->id }}</th>
                <td>{{ $apartment->title }}</td>
                <td>{{ $apartment->address }}</td>
                <td>
                    <a href="{{ route('renter.apartment.show', $apartment) }}"><button type="button" class="btn btn-primary float-start btn-sm mx-2">Prikazi</button></a>
                    <a href="{{ route('renter.apartment.edit', $apartment) }}"><button type="button" class="btn btn-warning float-start btn-sm mx-2">Uredi</button></a>
                    <!--<a href="{{ route('renter.apartment.delete', $apartment) }}"><button type="button" class="btn btn-danger">Izbrisi</button></a>-->
                    <form action="{{ route('renter.apartment.delete', $apartment->id) }}" method="POST" class="float-start">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-sm">Izbrisi</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    


    <!--<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">Stanovi</div>
                        <div class="col-md-6">
                            <div class="text-end">
                                <a class="btn btn-primary" href="{{ route('renter.apartment.create') }}">Add apartment</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        
                        @foreach($apartments as $apartment)
                            <div class="col-md-6 border">
                                <p>{{ $apartment }}</p>
                                <a href="{{ route('renter.apartment.show', $apartment) }}">Show apartment</a>
                                <a href="{{ route('renter.apartment.edit', $apartment) }}">Edit apartment</a>
                                <a href="{{ route('renter.apartment.delete', $apartment) }}">Delete apartment</a>
                            </div>
                        @endforeach
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection
