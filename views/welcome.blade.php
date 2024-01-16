@extends('layouts.public.app')

@section('content')

    <!--<img src="{{ asset('storage/buildings.png') }}" class="card-img-top" height="500px">
    <div class="container" style="min-height:70vh"> -->
  

    
   <!-- <div class="bg-image" 
     style="background-image: url('img/slikastanovi.jpg');
            height: 100vh">  -->

    <div class="row"> 
    <div class="col">
      
    </div>   
        <img src="img/slikastanovi.jpg" style="height:50vh; width:100%">
        <div class="col-md-7 mx-auto">
        <h2 class="text-center shadow-lg p-2 font-weight-bold bg-warning rounded m-1">Pronađite smještaj u bilo kojem gradu!</h1>
</div>
    </div>
        <div class="row mt-10">
            <!-- <div class="col-md-7 mx-auto"> 
                <h2 class="text-center shadow-lg p-2 font-weight-bold bg-warning rounded m-1">Pronađite smještaj u bilo kojem gradu!</h1>
            -->
            <div class="col-md-7 mx-auto">
                <form action="details.php" method="post" class="p-3">
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control form-control-lg rounded-2 border-info" placeholder="Unesite ime grada..." autocomplete="off" required>
                        
                        <button type="button" class="btn btn-primary btn-lg rounded">Traži</button>
                        
                        <div class="input-group-append">
                            <!--<input type="submit" name="submit" value="Search" class="btn btn-info btn-lg rounded-0">-->
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="col-md-5" style="position: relative;margin-top: -38px; margin-left: 215px;">
                <div class="list-group mt-2 mx-4" id="show-list">

                </div>
            </div>
        </div>
  </div>
</div>
</div>
    
<script>
$(document).ready(function () {
  // Send Search Text to the server
    $("#search").keyup(function () {
        let searchText = $(this).val();
        if (searchText !== "") {
        $.ajax({
            //url: "{{ route('user.serach.cities') }}",
            url: "{{ URL::to('search') }}",
            method: "GET",
            data: {
                name: searchText,
            },
            success: function (response) {
                console.log(response.cities)
                $('#show-list').html('')
                $.each(response.cities, function(key, value){
                    var url = '{{ route("user.serach.city", ":id") }}';
                    url = url.replace(':id', value.id);
                    //$('#show-list').append('<li class="list-group-item">'+ value.name +'</li>')
                    $('#show-list').append('<a href="'+ url +'" class="list-group-item list-group-item-action mt-2">'+ value.name +'</a>')
                })
                //$('#result').html('<li class="list-group-item">haha</li>')
                //$("#show-list").html(response);
            },
        });
        } else {
            $("#show-list").html("");
        }
    });
});

</script>

@endsection('content')