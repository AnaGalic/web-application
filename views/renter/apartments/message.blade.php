@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">Poruke </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h3>Poruke</h3>
                    <h4>Neprocitano: {{ $count }}</h4>
                    
                    <hr>
                    
                    @foreach ($messages as $message)
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $message->apartments->title }}</h5>
                            <div style="border: 1px solid red">
                                <p class="card-text">{{ $message->content }}</p>
                                <p>Korisnik: {{ $message->users->name }}</p>

                            </div>
                            @foreach ($replies as $reply)
                                <p>Ja: {{ Auth::user()->name }} | {{ $reply->content }} Status: @if($message->status == 0) neprocitano @endif</p>
                            @endforeach
                            
                            <!--<button type="button" class="btn btn-primary" onclick="sendMessage(4)" id="insert" value="insert">Odgovori</button>-->
                            
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="reply(this)" data-messageid="{{ $message->id }}">Odgovori</a>
                            
                            <!-- <form id="asd" style="display:none" action="{{-- route('renter.apartment.contact', 1) --}}" method="POST">
                                @csrf
                                <input type="hidden" id="user" name="message_id" value="{{ $message->id }}">
                                <input type="hidden" id="user" name="user_id" value="{{ $message->users->id }}">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Example textarea</label>
                                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mb-3">Posalji poruku</button>
                            </form> -->
                        </div>
                    @endforeach

                    
                        <div class="replyDiv" style="display:none;">
                            <form action="{{ route('renter.apartment.reply') }}" method="POST">
                                @csrf
                                <input type="text" id="messageId" name="message_id" hidden>
                                <textarea class="form-control" name="content" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                
                                <!--<a href="" class="btn btn-primary btn-sm">Pošalji</a>-->
                                <button type="submit" class="btn btn-primary btn-sm">Posalji poruku</button>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="reply_close(this)">Zatvori</a>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>

    function reply (caller) {
        document.getElementById('messageId').value = $(caller).attr('data-messageid')
        $('.replyDiv').insertAfter($(caller));
        $('.replyDiv').show();
        
    }

    function reply_close (caller) {
        $('.replyDiv').hide();
    }
    
    function sendMessage () {   
        var button = document.getElementById("insert").value
        document.getElementById("asd").style.display = "block";
        console.log("Klik")
    
    }
    
</script>