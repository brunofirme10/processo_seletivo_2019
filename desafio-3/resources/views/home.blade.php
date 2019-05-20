<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Data Nascimento</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($users as $user)
      <tr>
        <td>{{$user['id']}}</td>
        <td>{{$user['nome']}}</td>
        <td>{{$user['email']}}</td>
        <td>{{$user['data_nascimento']}}</td>
        
        <td><a href="{{action('UsuarioController@editarUsuario', $user['id'])}}" class="btn btn-warning">Editar</a></td>
        <td>
          <form action="{{action('UsuarioController@deletarUsuario', $user['id'])}}" method="get">
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </body>
</html>
