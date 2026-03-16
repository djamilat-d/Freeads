@extends("dashboard")
@section("logo_text")
    {{ __('Freeads') }}
@endsection
@section("content")
{{-- <nav class="nav-bar">
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
    
</nav> --}}
<div style="background-image: url('{{ asset('images/font.jpg') }}'); background-size: cover;background-attachment: fixed; height: 60vh;background-position: center;display: flex; flex-direction: column;justify-content: center; align-items: center; color: white;text-align: center; ">
    <h1>Trouvez le mobilier de vos reves</h1>
    <p>Des milliers d'Annonces de decoration et d'ameublement</p>
</div>

<strong><h1 class="text-center font-bold text-2xl text-gray-800">Nos Annonces Maison et Ameublement</h1></strong><br>

<div>
    <form action="{{ route('acceuil') }}" method="get" class="flex flex-col md:flex-row flex-wrap gap-4 p-4 bg-white shadow rounded-lg">
        <input type="text" name="search" placeholder="Rechercher..." >
        <select name="Category" id="">
            <option value="">Toutes les categories</option>
            <option value="Meubles" >Meubles</option>
            <option value="Decoration">Decoration</option>
            <option value="Bricolage">Bricolage</option>
            <option value="Jardinage">Jardinage</option>
            <option value="Electromenager">Electromenager</option>
        </select>

        <button type="submit" class="p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800">Rechercher</button>
        <a href="{{ route('acceuil') }}" class="rounded-full p-2.5 font-medium text-gray-400 bg-gray-200 hover:text-red-700 hover:bg-red-100 transition-colors duration-200">Effacer</a>
    </form>
</div><br>

<div style="display: flex;flex-direction:column;gap:20px;">
    @foreach ($ads as $ad)
        <div style="border: 1px solid ; padding:10px; border-radius:8px;">
            <h2>{{ $ad->title }}</h2><br>
            <img src="{{ asset($ad->image) }}" alt="{{ $ad->title }}" style="width: 500px; height: auto; border-radius: 15px;">

            <p><strong>Categorie:</strong> {{ $ad->category }}</p><br>
            <p><strong>Prix:</strong> {{ $ad->price }} Fcfa</p><br>
            <p><strong>Description:</strong> {{ $ad->description }}</p><br>
            <p><strong>Lieu:</strong> {{ $ad->location }}</p><br>

            @if(auth()->check() && $ad->user_id=== auth()->id())
                <div>
                    <a href="{{ route('ads.edit',$ad->id) }}" class="gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out font-medium text-sm shadow-sm hover:shadow">Modifier</a>
                    <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" style="display: inline" >
                        @csrf
                        <button type="submit" class="gap-2 px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-300 ">Supprimer</button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
    {{ $ads->links() }}
</div>
<footer class="mt-12 bg-gray-100 border-t border-gray-200 pt-8 pb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> 
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="">
                <h3 class="text-lg font-bold text-gray-700">Freeads</h3>
                <p class="mt-2 text-sm text-gray-500">Plateforme simple pour vendre et acheter vos meubles et objets de decoration.</p>
            </div>
        
            <div>
                <h3 class="text-sm font-semibold uppercase">Navigation</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="{{ route('acceuil') }}" class="text-base text-gray-600 hover:text-blue-600">Acceuil</a></li>
                    <li><a href="{{ route('ads.create') }}" class="text-base text-gray-600 hover:text-blue-600">Publier une Annonce</a></li>
                </ul>
            </div>
        
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase ">Contact</h3>
                <p class="mt-4 text-base text-gray-600 italic">Besoin d'aide ?</p>
                <p class="mt-4 text-base text-gray-600 font-medium">support@freeads.com</p>
            </div>
        </div>
    </div>
</footer>
@endsection