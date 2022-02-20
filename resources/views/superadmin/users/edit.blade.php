@extends('templates.main')

@section('content')
<h1>Edit  user</h1>

<div class="card">

<form method="POST" action="{{route('superadmin.users.update',$user->id)}}">
    @method('PATCH')  <!--partial update method -->
 @include('superadmin.users.partials.form')
</form>
</div>




@endsection
