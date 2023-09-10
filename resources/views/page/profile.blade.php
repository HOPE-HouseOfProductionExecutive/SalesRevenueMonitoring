@extends('layout.master')
@section('content')
    <link rel="stylesheet" href="/assets/css/profile/style.css">

    <h3 class="title-heading">Profile</h3>
    <div class="containers">
        <div class="left">
            <img src="{{ Storage::url(Auth::user()->photo_path) }}" alt="">
            <label for="photo" style="background-color: {{Auth::user()->gender == 'Male' ? '#B3D3E3' : '#F2BED1'}}">Change Picture</label>
            <input type="file" name="photo" id="photo" hidden>
            <label for="">Change Password</label>
        </div>
        <div class="right">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}">
        </div>
    </div>


@endsection
