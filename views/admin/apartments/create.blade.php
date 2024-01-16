@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                    <div class="col-md-6">Apartment</div>
                </div>

                <div class="card-body">
                    <h3>Apartment Create</h3>
                    <form action="{{ route('admin.apartment.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="text" class="form-label">Unesite grad:</label>
                        <input type="text" class="form-control" id="email" placeholder="Unesite grad" required name="name">
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Postanski broj:</label>
                        <input type="number" class="form-control" id="num" placeholder="Unesite postanski broj" name="zip_code">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
