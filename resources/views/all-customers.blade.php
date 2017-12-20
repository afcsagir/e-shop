@extends('layouts.app')
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
@section('content')


	<table class="table">
    <thead>
      <tr>
        <th>ID ({{ $count }})</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>City</th>
        <th>Phone</th>
        <th>Created</th>
      </tr>
    </thead>
    <tbody>

@foreach($users as $user)

      <tr>
        <td><h4>{{ $user->id }}</h4></td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->address1 }}</td>
        <td>{{ $user->city }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{ $user->created_at }}</td>
      </tr>
      

@endforeach

    </tbody>
  </table>

@endsection

