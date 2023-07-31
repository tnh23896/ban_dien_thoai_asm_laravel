<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Cảm ơn bạn đã đặt hàng!</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>

    <div class="container">
      <div class="text-center pt-5 pb-3">
        <h1 class="display-4 text-success">Cảm ơn bạn!</h1>
        <p class="lead">Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi.</p>
        <hr class="my-4">
      </div>

      <div class="row">
        <div class="col-lg-6 mx-auto">
        
          <p>Xin chào {{ $name }},</p>
          
          <p>Chúng tôi rất vui vì bạn đã lựa chọn sản phẩm của chúng tôi. Đơn hàng #{{ $orderId }} của bạn đã được xác nhận.</p>

          <p>Chúng tôi sẽ sớm giao hàng tới địa chỉ của bạn.</p>

          <p class="mb-4">Nếu bạn có bất kỳ thắc mắc gì về đơn hàng, vui lòng liên hệ với chúng tôi.</p>

        </div>
      </div>
      
    </div>

  </body>
</html>