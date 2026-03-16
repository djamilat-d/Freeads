@extends("dashboard")
@section("logo_text")
    {{ __('Admin') }}
@endsection
@section("content")
<div style="display: flex;flex-direction:column;gap:20px;">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Login</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Admin</th>
                <th colspan="2" class="">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->login}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>
                        @if($user->admin == 0)
                        NON
                        @else
                        OUI
                        @endif
                    </td>
                    <td><a class="btn btn-outline-dark" href="{{ route('admin.editUser', $user->id) }}">Modifier</a></td>
                    <td>
                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection