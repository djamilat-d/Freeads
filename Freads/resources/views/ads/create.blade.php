<h1>Poster Annonce</h1>
<form action="{{ route('ads.store') }}" method="post" enctype="multipart/form-data">
    @csrf 
    <input type="text" name="title" placeholder="Titre de l'annonce" required><br><br>
    <select name="category" id="" required>
        <option value="Meubles">Meubles</option>
        <option value="décoration">décoration</option>
        <option value="bricolage">bricolage</option>
        <option value="ijardinage">jardinage</option>
        <option value="électroménager">électroménager</option>
    </select><br><br>
    <textarea name="description" placeholder="Description..." id="" cols="30" rows="10" required></textarea><br><br>
    <input type="file" name="image" accept="image/*" required><br><br>
    <input type="number" name="price" placeholder="Prix..." required><br><br>
    <input type="text" name="location" placeholder="Localition..." required><br><br>
    <button type="submit" class="btn btn-primary">Publier</button>
</form>