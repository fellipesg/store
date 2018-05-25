<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
      <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Preco</th>
        <th>Quantidade Disponível</th>
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
  </div>
  </body>

  <script type="text/javascript">
    $(document).ready(function($){
     $('#delete').on('submit',function(e){
        if(!confirm('Tem certeza que deseja apagar este produto?')){
              e.preventDefault();
        }
      });
    });
  </script>
</html>