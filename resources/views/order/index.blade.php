<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Notas</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
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
        <th>Date</th>
        <th>Description</th>
        <th>Cliente</th>
        <th>Vendedor</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($orders as $order)
      <tr>
        <td>{{$order['id']}}</td>
        <td>{{$order['date']}}</td>
        <td>{{$order['description']}}</td>
        <td>{{ $order->client['name'] }}</td>
        <td>{{ $order->user['name'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </body>
</html>