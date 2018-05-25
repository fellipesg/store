<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Edicao de Produto</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      <h2>Alteracao de dados do Produto</h2><br  />
        <form method="post" action="{{action('ProductController@update', $id)}}">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="name" value="{{$product->name}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="email">Preco</label>
              <input type="text" class="form-control" name="price" value="{{$product->price}}">
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="number">Quantidade:</label>
              <input type="text" class="form-control" name="quantity" value="{{$product->quantity}}">
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>