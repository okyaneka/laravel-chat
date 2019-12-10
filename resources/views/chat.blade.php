@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">List</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach (\App\User::all() as $user)
                        <li class="list-group-item">
                            <a class="text-primary" href="{{ route('read.chat', $user) }}">{{ $user->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Route::is('read.chat') ? $receiver->name : 'Chat' }}</div>
                <div class="card-body">
                    <div id="message-area" class="mb-3" style="height: 400px !important;">
                        @if (Route::is('chat'))
                        <h1 class="text-muted text-center p-5">Chat</h1>
                        @else
                        @foreach ($messages as $message)
                        <div class="row mb-3">
                            <div class="col-sm-6{{ $message->sender == auth()->user() ? ' offset-sm-6' : '' }}">
                                <div class="card{{ $message->sender == auth()->user() ? ' bg-light' : '' }}">
                                    <div class="card-body">
                                        <p class="card-text">{{ $message->message }}</p>
                                        <small class="text-muted"><i class="far fa-clock mr-2"></i>{{ date('G:i:s Y-m-d', strtotime($message->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div id="message-input">
                        <div class="row">
                            <div class="col">
                                <div class="form-row">
                                    <div class="col">
                                        <label class="sr-only" for="message">Message</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="message" placeholder="Message"
                                                name="message">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
