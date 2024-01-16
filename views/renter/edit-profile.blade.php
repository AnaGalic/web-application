@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Moj profil') }}</div>   <br>  <br>
               

                    <div class="col-lg-12">
                    <!-- <div class="card mb-2"> -->
                        
                    <div class="row mb-3">
                            <label for="text" class="col-md-4 col-form-label text-md-end">{{ __('Ime i prezime') }}</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control @error('text') is-invalid @enderror" name="text" placeholder ="Ime i prezime"value="{{ old('text') }}" required autocomplete="text" autofocus>
                               
                            </div>
                        </div>

                    <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder ="Email adresa"value="{{ old('email') }}" required autocomplete="email" autofocus>
                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Lozinka') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder ="Lozinka"required autocomplete="current-password">

    
                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Potvrdi lozinku') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder ="Potvrdi lozinku" required autocomplete="new-password">
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                        <form>
                        <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('Odaberi sliku profila') }}</label>
                        <input type="file" id="myfile" name="myfile"><br><br>

                            </div>
                        </div>


                        </div>
                        </div>
                        <div class="d-flex justify-content-center mb-2">
                            <a href="{{ route('renter.user.edit-profile') }}" class="btn btn-primary">Odustani</a>
                            <button type="button" class="btn btn-primary ms-1">Spremi promjene</button>
                            </div>
                        <div class="row">
                        <div class="col-md-6">
                            
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                        </div>
                   <!-- </div> -->
                    </div>
                </div>
                </section>
               
            </div>
        </div>
    </div>
</div>
@endsection


    
