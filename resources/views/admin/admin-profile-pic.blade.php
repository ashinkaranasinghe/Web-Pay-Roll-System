@extends('layouts.edit_office_info')

@section('title',"Admin")

@section('utypemin',"A")

@section('utype',"Admin")

@section('avators')
@foreach($propic as $emp)
<img src="/uploads/avatars/{{$emp->avatar}}" class="img-circle" alt="User Image">
@endforeach
@endsection

@section('names')
<p>{{ Auth::user()->username }}</p>
<a href="{{ route('admin-myprofile') }}">
@endsection

@section('records')
<a href="{{ route('user.records') }}">
@endsection

@section('myprofile')
<a href="{{ route('admin-myprofile') }}">
@endsection

@section('functions01',"Manage Users")

@section('prop_imgs')   
    @foreach($data as $emp)
    <center><img src="/uploads/avatars/{{$emp->avatar}}" style="border-radius:50%;" alt="5" ></center>
    @endforeach
 @endsection

 @section('forms')   
    <form enctype="multipart/form-data" action="{{route('admin-editmy_profile')}}" method="post">
 @endsection

 @section('backbtn')   
 <a class="pull-left btn  btn-danger btn-block" href="{{route('admin-myprofile')}}">Back</a>
 @endsection