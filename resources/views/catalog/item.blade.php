{!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') !!}
{!! Html::style('css/catalog.css') !!}

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Package Product - Laravel 5.1</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a href="{!! URL::to('/') !!}">Home</a></li>
        <li  class="active"><a href="{!! URL::to('/products') !!}">List products</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

	<div class="jumbotron">
		<h1>{!! $product->product_name !!} | ${!! $product->product_price !!} </h1>
		<p>
			@if (strlen($product->product_image) > 0)
			    <img class="img-product" src="../{!! $product->product_image !!}" alt="{!! $product->product_name !!}" width="200" height="150" title="{!! $product->product_name !!}">
			@else 
				<img class="img-product" src="../uploads/no-image.png" alt="No image" title="No image" width="200" height="150">
			@endif
		</p>
		<p>
			{!! $product->product_description !!} 
		</p>
	</div>	

</div>
