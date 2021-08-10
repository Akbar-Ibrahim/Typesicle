@extends('layouts.admin')

@section('content')
<div class="container" id="app">
    <div class="row justify-content-center ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit user') }}</div>


                <div class="row">

                    <div class="col-md-4 w3-center ">
                        <!--
                <img src="{{$user->photo ? $user->photo->file : '/images/kj.png'}}" alt="" class="img-responsive img-rounded" width="100%">                
-->
                        @if($user->profile->picture === 'avatar.png')
                        <img src="/images/avatar.png" class="w3-circle w3-margin-right w3-border"
                            style="width:260px; height:260px;">
                        @else
                        <img src="/images/{{ $user->id }}/profile_pic/{{ $user->profile->picture }}"
                            class="w3-circle w3-margin-right w3-border" style="width:260px; height:260px;">
                        @endif

                        <div class="w3-container" style="font-size: 30px;">
                        <a href="{{ route('profile.show', Auth::user()->username) }}"> {{ $user->name }} </a>
                        </div>
                    </div>

                    <div class="col-md-8">

                        <div class="card-body">
                            <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">

                                <div class="form-group row">
                                    
                                    <div class="col-md-8">
                                    <label for="username"
                                        class="col-md-4 col-form-label ">{{ __('Username') }}</label>
                                        <input id="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') ?? $user->username }}" autocomplete="username"
                                            autofocus>

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-md-8">
                                    <label for="email"
                                        class="col-md-4 col-form-label ">{{ __('E-Mail Address') }}</label>

                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') ?? $user->email }}" autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-8">
                                    <label for="password"
                                        class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            value="{{ old('password') ?? $user->password}}" autocomplete="password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">

                                    <div class="col-md-8">
                                    <label for="role_id"
                                        class="col-md-4 col-form-label ">{{ __('Role') }}</label>
                                        <select id="role_id" type="number"
                                            class="form-control @error('role_id') is-invalid @enderror" name="role"
                                            autocomplete="new-role">

                                            <option value=""> Select a role </option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ $user->role == $role->name ? 'selected' : '' }}> {{ $role->name }} </option>
                                            @endforeach

                                        </select>

                                        @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-8">
                                    <label for="is_active"
                                        class="col-md-4 col-form-label ">{{ __('Status') }}</label>

                                        <select id="is_active" type="number"
                                            class="form-control @error('is_active') is-invalid @enderror"
                                            name="is_active" autocomplete="new-status">
                                            <option value="0"> Not Active </option>
                                            <option value="1"> Active </option>
                                        </select>

                                        @error('is_active')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Edit User') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body" style="border: 2px solid black;">
                    <form method="POST" action="/admin/users/{{$user->id}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-danger">
                                    {{ __('Delete User') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection