@extends('layouts.admin')

@section('content')
<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard | <a href="{{ route('profile.show', Auth::user()->username) }}"> Back to profile </a></div>

                <div class="card-body">
                    @if (session('deleted_user'))
                        <div class="alert alert-success" role="alert">
                            {{ session('deleted_user') }}
                        </div>
                    @endif
                </div>


                    <div class=" py-4 pl-4"> Users | {{ count($users)}}  </div>

                </div>

<table class="table">
    <thead>
      <tr>
        <th> Id </th>
        <th> Photo </th>
        <th> Name </th>
        <th> Email </th>
        <th> Role </th>
        <th> Status </th>
        <th>  </th>
        <th> Created </th>
        <th> Updated </th>
      </tr>
    </thead>
    <tbody>
    @if($users)
    @foreach($users as $user)
      <tr>
        <td> {{$user->id}} </td>
    
        <td> 
        @if($user->profile->picture === 'avatar.png')
                        <img src="/images/avatar.png" class="w3-circle w3-margin-right w3-border"
                            style="width:50px; height:50px;">
                        @else
                        <img src="/images/{{ $user->id }}/profile_pic/{{ $user->profile->picture }}"
                            class="w3-circle w3-margin-right w3-border" style="width:50px; height:50px;">
                        @endif    
      </td>
        <td> <a href="{{ route('profile.show', $user->username) }}">{{$user->username ?? ''}} </a></td>
        <td> {{$user->email}} </td>
        <td> {{$user->role ?? 'Not assigned'}} </td>
        <td> {{$user->is_active == 1 ? 'Active' : 'Not active'}} </td>
        <td> <a href="{{route('users.edit', $user->id)}}"> Edit </a> </td>
        <td> {{$user->created_at->toFormattedDateString() ?? 'No Date'}} </td>
        <td> {{$user->updated_at->toFormattedDateString() ?? 'No Date'}} </td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>


            </div>
        </div>
    </div>
</div>
@endsection
