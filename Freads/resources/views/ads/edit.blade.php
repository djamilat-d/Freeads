<h1>Modifier Annonce</h1>
<form action="{{ route('ads.update', $ad->id) }}" method="post" enctype="multipart/form-data">
    @csrf 
    <input type="text" name="title" value="{{ $ad->title }}" required><br><br>
    <select name="category" id="" required>
        <option value="Meubles" @@selected({{ $ad->category == 'Meubles' }})>Meubles</option>
        <option value="décoration" @@selected({{ $ad->category == 'décoration' }})>décoration</option>
        <option value="bricolage" @@selected({{ $ad->category == 'bricolage' }})>bricolage</option>
        <option value="jardinage" @@selected({{ $ad->category == 'jardinage' }})>jardinage</option>
        <option value="électroménager" @@selected({{ $ad->category == 'électroménager' }})>électroménager</option>
    </select><br><br>
    <textarea name="description" cols="30" rows="10" required>{{ $ad->description }}</textarea><br><br>
    <input type="file" name="image" accept="image/*" required><br><br>
    <input type="number" name="price" value="{{ $ad->price }}" required><br><br>
    <input type="text" name="location" value="{{ $ad->location }}" required><br><br>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>