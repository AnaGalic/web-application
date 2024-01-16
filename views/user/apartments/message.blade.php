@extends('layouts.public.app')

@section('content')

<div class="container mt-4" style="min-height:70vh">
    <h3>Poruke</h3>
    
    <input type="text" id="apartmentId" name="apartment_id" hidden value="@if(isset($apartment)){{ $apartment->id }} @endif">
        @if (isset($apartments))
            @foreach ($apartments as $apartment)
            <hr>
                {{ $apartment->title }} 
            @foreach ($apartment->messages as $message)
                <br>
                @if ($message->user_id == Auth::user()->id)
                    {{ $message }}
                @endif
            @endforeach
            <br>
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="reply(this)" data-messageid="@if(isset($message)){{ $message->id }} @endif">Odgovori</a>
        <br>
        @endforeach
<br>
@endif
    @foreach ($messages as $message)
        <h5><b>{{ $message->apartments->title }}</b></h5> <br>
        <b>Poruka: </b> {{ $message->content }} <br>
        @foreach ($message->replies as $reply)
        <b>Odgovor:</b> {{ $reply->content }} <br>
        @endforeach
        <br>
        <a href="javascript:void(0)" class="btn btn-primary btn-sm"  onclick="reply(this)" data-messageid="@if(isset($message)){{ $message->id }} @endif">Odgovori</a>
        
    <hr>
    @endforeach

    @if(!empty($apartment) && empty($message))
        <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="sendMessage(this)" data-messageid="6">Posalji prvu poruku iznajmljivacu</a>
   @endif

        <div class="replyDiv" style="display:none;">
            <form action="{{ route('user.apartment.reply') }}" method="POST">
                @csrf
                <input type="text" id="messageId" name="message_id" hidden>
                <textarea class="form-control" name="content" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                
                <!--<a href="" class="btn btn-primary btn-sm">Pošalji</a>-->
                <button type="submit" class="btn btn-primary btn-sm">Posalji poruku</button>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="reply_close(this)">Zatvori</a>
            </form>
        </div>

        <!--<div id="contact"> -->
            <form id="asd" style="display:none" action="{{ route('user.apartment.send') }}" method="POST">
                @csrf
                <input type="text" id="userId" name="user_id" hidden value="{{ Auth::user()->id }}">
                @if(isset($apartment))
                <input type="text" id="apartmentId" name="apartment_id" hidden value="@if(!empty($apartment)){{ $apartment->id }} @endif">
                @endif
                <div class="col-lg-8">

            <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                <div class="col-sm-3">
        
            </div>
            </div>
            
                <div class="mb-3">
                    
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Posalji prvu poruku </button>
            </form>
        <!--</div> -->
   

</div>



<!--

<input type="text" id="apartmentId" name="apartment_id" hidden value="@if(isset($apartment)){{ $apartment->id }} @endif">

    <div class="card-body">

    @if (isset($apartments))
    
        @foreach ($apartments as $apartment)
            <hr>
                {{ $apartment->title }} 
            
            @foreach ($apartment->messages as $message)
                <br>
                @if ($message->user_id == Auth::user()->id)
                    
                    {{ $message }}
                    
                @endif
                
            @endforeach
            <br>
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="reply(this)" data-messageid="@if(isset($message)){{ $message->id }} @endif">Odgovori</a>
        <br>
        @endforeach
        
    <br>
    @endif

        
        @foreach ($messages as $message)
            <h3>{{ $message->apartments->title }}</h3> <br>
            {{ $message->content }} <br>
            @foreach ($message->replies as $reply)
                {{ $reply->content }} <br>
            @endforeach
            <br>
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="reply(this)" data-messageid="@if(isset($message)){{ $message->id }} @endif">Odgovori</a>
           
        <hr>
        @endforeach
             
            
        @if(!empty($apartment) && empty($message))
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="sendMessage(this)" data-messageid="6">Posalji prvu poruku iznajmljivacu</a>
            
            <!-<a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="reply(this)" data-messageid="@if(isset($message)){{ $message->id }} @endif">Odgovori</a>--
        @endif
        
    
        
        <div class="replyDiv" style="display:none;">
            <form action="{{ route('user.apartment.reply', 1) }}" method="POST">
                @csrf
                <input type="text" id="messageId" name="message_id" hidden>
                <textarea class="form-control" name="content" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                
                <!--<a href="" class="btn btn-primary btn-sm">Pošalji</a>--
                <button type="submit" class="btn btn-primary btn-sm">Posalji poruku</button>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="reply_close(this)">Zatvori</a>
            </form>
        </div>
        
            
            <!--<button type="button" onclick="sendMessage()" id="insert" value="Add new Product">Posalji poruku iznajmljivacu</button> --
            @if (2 == 3)
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="sendMessage(this)" data-messageid="6">Posalji prvu poruku iznajmljivacu</a>
            @endif
            <div id="contact">
                <form id="asd" style="display:none" action="{{ route('user.apartment.send') }}" method="POST">
                    @csrf
                    <input type="text" id="userId" name="user_id" hidden value="{{ Auth::user()->id }}">
                    @if(isset($apartment))
                    <input type="text" id="apartmentId" name="apartment_id" hidden value="@if(!empty($apartment)){{ $apartment->id }} @endif">
                    @endif
                    <div class="mb-3">
                        <label for="content" class="form-label">Example textarea</label>
                        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Posalji prvu poruku </button>
                </form>
            </div>
            <hr>
          
    </div> -->

    <!--@foreach ($messages as $message)
        {{ $message }}
        @foreach ($message->apartments as $apartment)
            {{ $apartment }}
        @endforeach
    @endforeach -->
        
        <!--@if(isset($messages))
            @foreach ($messages as $message)
                {{ $message->content }}
                <br>
                @foreach ($message->replies as $reply)
                        {{ $reply->content }} <br>
                @endforeach
            @endforeach
        @endif -->

@endsection

<script>
    /*window.onload = function() {
        document.getElementById("asd").style.display = "none";
    };*/


    function sendMessage () {
       
        document.getElementById("asd").style.display = "block";  
    }

    function reply (caller) {
        document.getElementById('messageId').value = $(caller).attr('data-messageid')
        $('.replyDiv').insertAfter($(caller));
        $('.replyDiv').show();
        
    }

    function reply_close (caller) {
        $('.replyDiv').hide();
    }
    
    /*function sendMessage () {   
        var button = document.getElementById("insert").value
        document.getElementById("asd").style.display = "block";
        console.log("Klik")
    } */
</script>