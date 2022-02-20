@extends('templates.main')

@section('content')
<h1>Users for superAdmin</h1>
<div class="row">
    <div class="col-12">
    <h1 >Users</h1>

    <a  class="btn btn-sm btn-success float-end" href="{{route('superadmin.users.create')}}" role='button' >Create</a>


    </div>
</div>

<div class="card">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
@foreach($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
            <a class="btn btn-sm btn-primary" href="{{route('superadmin.users.edit',$user->id)}}" role='button' >Edit</a>

            <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-user-form-{{$user->id}}').submit()">Delete</button>
           
            <form id="delete-user-form-{{$user->id}}" action="{{route('superadmin.users.destroy',$user->id)}}" method="POST" style="display :none;">
            @csrf
            @method("DELETE")
        
            </form>



      </td>
    </tr>
@endforeach

  </tbody>
</table>
<!-- It's not the same $users, this $users is from UserController ...paginate... -->
{{$users->links()}} 

</div>
@endsection
