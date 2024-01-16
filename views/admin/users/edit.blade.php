@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.user.update', $user) }}" method="POST">
                        @csrf
                        @foreach($roles as $role)
                            <div class="form-check">
                                <label>{{ $role->name }}</label>
                                <input type="radio" name="role" required value="{{ $role->id }}">
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
