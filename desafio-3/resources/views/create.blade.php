<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      <h2>Criar Usuários</h2><br/>
      <form method="post" action="{{url('create')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Nome">Nome:</label>
            <input type="text" class="form-control" name="nome">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Email">Email:</label>
              <input type="text" class="form-control" name="email">
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Date">Data de Nascimento</label>
              <input type="date" class="form-control" name="date">
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
          <form action="{{action('UsuarioController@criarUsuario')}}" method="get">          
            <button type="submit" class="btn btn-success">Enviar</button>
          </form>  
          </div>
        </div>
      </form>
    </div>
  </body>
</html>