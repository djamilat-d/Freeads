<nav class="nav-bar">
    <a href="{{ route('acceuil') }}" class="logo">FREEADS</a>
    <div class="nav-links">
        <a href="{{ route('acceuil') }}">Acceuil</a>
        @auth
            <a href="{{ route('ads.create') }}" class="btn-create">Publier une annonce</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline">
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('register') }}">Inscription</a>
                <a href="{{ route('dashboard') }}">Administrateur</a>
                
                <a href="#" onclick="">Deconnexion</a>
            </form>
        @endauth
    </div>
    
</nav>


<h1>Annonces</h1>

<div style="display: flex;flex-direction:column;gap:20px;">
    @foreach ($ads as $ad)
        <div style="border: 1px solid ; padding:10px; border-radius:8px;">
            <h3>{{ $ad->title }}</h3>
            <img src="{{ asset($ad->image) }}" alt="{{ $ad->title }}" style="width: 200px; height: auto; border-radius: 5px;">

            <p><strong>Categorie:</strong> {{ $ad->category }}</p>
            <p><strong>Prix:</strong> {{ $ad->price }} Fcfa</p>
            <p><strong>Description:</strong> {{ $ad->description }}</p>
            <p><strong>Lieu:</strong> {{ $ad->location }}</p>

            @if(auth()->check() && $ad->user_id=== auth()->id())
                <div>
                    <a href="{{ route('ads.edit',$ad->id) }}" style="color: blue;">Modifier</a>
                    <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" style="display: inline" >
                        @csrf
                        <button type="submit" btn btn-primary style="color: red;">Supprimer</button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
</div>