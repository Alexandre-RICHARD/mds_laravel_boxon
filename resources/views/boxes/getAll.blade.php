<div class="container">
  <h1>Liste des Boxes</h1>
  <table class="table">
      <thead>
          <tr>
              <th>ID</th>
              <th>Adresse</th>
              <th>Numéro</th>
              <th>Taille</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($boxes as $box)
              <tr>
                  <td>{{ $box->id }}</td>
                  <td>{{ $box->adress }}</td>
                  <td>{{ $box->number }}</td>
                  <td>{{ $box->size }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>
