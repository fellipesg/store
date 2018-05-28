<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Criacao de Nota </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script
      src="https://code.jquery.com/jquery-2.2.4.min.js"
      integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous">
      </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>  
  </head>
  <body>
    <?php  
    setlocale(LC_MONETARY,"pt_BR", "ptb");
    ?>
    <div class="container">
      <h2>Criacao de novo produto</h2><br/>
      <form method="post" action="{{url('orders')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Description:</label>
            <input type="text" class="form-control" name="description">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Vendedor:</label>
            <input type="text" class="form-control" name="seller" value="{{ $seller->name }}" readonly>
            <input type="hidden" name="seller_id" value="{{ $seller->id }}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Cliente:</label><br>
            <select name="client">
              @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->user->name }}</option>
              @endforeach
            </select>
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
              <th>Nome</th>
              <th>Preco</th>
              <th>Quantidade do pedido</th>
              <th colspan="1">Acoes</th>
            </tr>
          </thead>
          <tbody>
            
            @foreach($products as $key => $product)
            <tr class="produtos">
              <td>{{$product['name']}}</td>
              <td>
                  <div class="price">R$ {{$product['price']}}</div>
                  <input type="hidden" name="products[{{ $key }}][price]" value="{{$product['price']}}">
              </td>
              <td>
                  <input type="number" name="products[{{ $key }}][quantity]" class="quantity" min="1" step="1" value="1" maxlength="{{ $product['quantity'] }}">
              </td>
              <input type="hidden" name="products[{{ $key }}][id]" value="{{ $product->id }}">
              <td><button class="btn btn-danger" type="submit" id="{{ $key }}">Delete</button></td>
            </tr>
            @endforeach
            <tr>
              <th>Total</th>
            </tr>
            <tr>
              <td id="totals" style="float: right;">R$ 0,00</td>
            </tr>
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
      function moneyTextToFloat(text) {
        var cleanText = text.replace("R$ ", "").replace(",", ".");
        return parseFloat(cleanText);
      }
      function floatToMoneyText(value) {        
        var text = (value < 1 ? "0" : "") + Math.floor(value*100);
        text = "R$ " + text;
        return text.substr(0, text.length -2) + "," + text.substr(-2);
      }
      function readTotal() {
        var total = $('#totals').text();
        return moneyTextToFloat(total);
      }
      function writeTotal(value) {
        $('#totals').text(floatToMoneyText(value));
      }
      function updateTotals() {
          var products = document.getElementsByClassName('produtos');
          var totalProdutos = 0;
          for(var pos = 0; pos < products.length; pos++ ) {
            var priceElements = products[pos].getElementsByClassName('price');
            var priceText = priceElements[0].innerHTML;
            var price = moneyTextToFloat(priceText);
            var qtyElements = products[pos].getElementsByClassName('quantity');
            var qtyText = qtyElements[0].value;
            var quantity = moneyTextToFloat(qtyText);
            var subtotal = quantity * price;
            totalProdutos += subtotal;
          }
          return totalProdutos;
      }
      function quantityChanged() {
        writeTotal(updateTotals());
      }
      function onDocumentLoad() {
        var textEdits = document.getElementsByClassName('quantity');
          for(var i = 0; i< textEdits.length; i++){
            textEdits[i].onchange = quantityChanged();
          }
      }
      window.onload = onDocumentLoad;
    </script>
    <script type="text/javascript">  
        $('#datepicker').datepicker({ 
            autoclose: true,   
            format: 'dd-mm-yyyy'  
         });  
        $(document).ready(function () {
          $('.quantity').change(function(){
              quantityChanged();
          });
          $('.btn-danger').click(function(){
            $('#tr_'+$(this).attr('id')).remove();
          });
        })
    </script>
  </body>
</html>
