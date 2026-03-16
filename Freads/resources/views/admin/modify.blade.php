@extends("dashboard")
@section("logo_text")
    {{ __('Modifier les droits') }}
@endsection
@section("content")
    <form action="{{ route('admin.modifyUser', $user->id) }}" method="post">
        @csrf
        <!-- Id -->
        <div class="mt-4">
            <x-input-label for="id" :value="__('Id')" />
            <x-text-input id="id" class="block mt-1 w-full" type="text" value="{{ $user->id }}" disabled />
        </div>
        <!-- Login -->
        <div class="mt-4">
            <x-input-label for="login" :value="__('Login')" />
            <x-text-input id="login" class="block mt-1 w-full" type="text" value="{{ $user->login }}" disabled />
        </div>
        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" value="{{ $user->name }}" disabled />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" value="{{ $user->email }}" disabled autocomplete="username" />
        </div>
        <!-- Phone_number -->
         <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone_number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" value="{{ $user->phone_number }}" disabled />
        </div>
        <!-- created_ad -->
         <div class="mt-4">
            <x-input-label for="created_at" :value="__('Date de creation')" />
            <x-text-input id="created_at" class="block mt-1 w-full" type="text" value="{{ $user->created_at }}" disabled />
        </div>
        <!-- updated_at -->
         <div class="mt-4">
            <x-input-label for="updated_at" :value="__('Date derniere modification')" />
            <x-text-input id="updated_at" class="block mt-1 w-full" type="text" value="{{ $user->updated_at }}" disabled />
        </div>
        <!-- Admin -->
         <div class="mt-4">
            <label for="admin">Admin</label>
            <select name="admin" id="admin" class="form-select" aria-label="Default select example">
                <option value="{{ $user->admin }}" selected>Changer les droits d'administrateur</option>
                <option value="0">NON</option>
                <option value="1">OUI</option>
            </select>
        </div>


        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-outline-dark">Appliquer</button>
        </div>
    </form>
    <form class="flex items-center justify-end mt-4" action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Supprimer</button>
    </form>
@endsection
@section("second_content")
<div style="display: flex;flex-direction:column;gap:20px;"  class="p-6 text-gray-900 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    @foreach ($ads as $ad)
        <div style="border: 1px solid ; padding:10px; border-radius:8px;">
            <h3>{{ $ad->title }}</h3>
            <img src="{{ asset($ad->image) }}" alt="{{ $ad->title }}" style="width: 200px; height: auto; border-radius: 5px;">

            <p><strong>Categorie:</strong> {{ $ad->category }}</p>
            <p><strong>Prix:</strong> {{ $ad->price }} Fcfa</p>
            <p><strong>Description:</strong> {{ $ad->description }}</p>
            <p><strong>Lieu:</strong> {{ $ad->location }}</p>

           <div>
                <form action="{{ route('admin.AdDestroy', ['AdId' => $ad->id, 'UserId' => $user->id]) }}" method="POST" style="display: inline" >
                    @csrf
                    <button type="submit" class="btn btn-outline-danger" style="color: red;">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection