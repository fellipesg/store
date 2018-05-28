<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Notas</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <?php  
    setlocale(LC_MONETARY,"pt_BR", "ptb");
    ?>
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
        <th>Products</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($orders as $order)
      <?php
          $d = new DateTime($order['date']);

          $timestamp = $d->getTimestamp(); // Unix timestamp
          $formatted_date = $d->format('d-m-Y'); 
      ?>
      <tr>
        <td>{{$order['id']}}</td>
        <td>{{$formatted_date}}</td>
        <td>{{$order['description']}}</td>
        <td>{{ $order->client->user->name }}</td>
        <td>{{ $order->user->name }}</td>
        <td>
          <table>
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Quantidade</th>
                  <th>Preco</th>
                </tr>
              </thead>
              <tbody>
                  <?php $total = 0;?>
                  @foreach($order->products as $product)
                  <?php $total += ($product->pivot->quantity * $product->pivot->price) ?>
                    <tr>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->pivot->quantity }}</td>
                      <td>{{ $product->pivot->price }}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <th></th>  
                    <th>Total</th>
                    <th></th>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="float: right;">R$ {{ number_format($total, 2) }}</td>
                  </tr>
                </tbody>
              </tbody>
          </table>
        </td>
      </tr>
      @endforeach
      
  </table>
  </div>
  </body>
</html>