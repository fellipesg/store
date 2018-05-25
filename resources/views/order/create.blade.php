<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Criacao de Nota </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
  </head>
  <body>
    <div class="container">
      <h2>Criacao de novo produto</h2><br/>
      <form method="post" action="{{url('products')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Description:</label>
            <input type="text" class="form-control" name="name">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <strong>Date : </strong>  
            <input class="date form-control"  type="text" id="datepicker" name="date">   
          </div>
        </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Preco</th>
              <th>Quantidade Disponível</th>
              <th>Quantidade do pedido</th>
              <th colspan="3">Actions</th>
            </tr>
          </thead>
          <tbody>
            
            @foreach($products as $product)

            <tr>
              <td>{{$product['id']}}</td>
              <td>{{$product['name']}}</td>
              <td>{{$product['price']}}</td>
              <td>{{$product['quantity']}}</td>
              <td><input type="number" name="quantity_products"></td>
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <td><a href="{{action('ProductController@edit', $product['id'])}}" class="btn btn-warning">Edit</a></td>
              <td>
                <form id="delete" action="{{action('ProductController@destroy', $product['id'])}}" method="post">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <script type="text/javascript">  
        $('#datepicker').datepicker({ 
            autoclose: true,   
            format: 'dd-mm-yyyy'  
         });  
    </script>
  </body>
</html>
