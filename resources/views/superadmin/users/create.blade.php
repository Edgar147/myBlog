@extends('templates.main')

@section('content')
<h1>Create new user</h1>

<div class="card">

<form method="POST" action="{{route('superadmin.users.store')}}">
@method('PATCH')  <!--partial update method -->

 @include('superadmin.users.partials.form')
</form>
</div>









@endsection
