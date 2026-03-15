<div style="display: flex;flex-direction:column;gap:20px;">
    @foreach ($users as $user)
        <div style="border: 1px solid ; padding:10px; border-radius:8px;">
            <h3>{{ $user->login }}</h3>

            <p><strong>Categorie:</strong> {{ $user->name }}</p>
            <p><strong>Prix:</strong> {{ $user->email }}</p>
        </div>
    @endforeach
</div>