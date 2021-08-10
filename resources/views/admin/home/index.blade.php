@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard | <a href="{{ route('profile.show', Auth::user()->username) }}"> Back to Profile </a></div>

                <div class="card-body">

                    <h1> Admin </h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

