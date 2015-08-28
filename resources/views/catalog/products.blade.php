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

<script>
	function checkDel()
	{
		return confirm("Are you want delete product?");
	}
</script>

<div class="container">

	<div class="pull-right">
		<!--search bar-->
		{!! Form::open(array(
			'url' => 'search-products', 
			'class'=>'form navbar-form navbar-right searchform')
		) !!}

	    {!! Form::text('txtkeyword', null,
	                   array('required',
	                        'class'=>'form-control',
	                        'placeholder'=>'Search...')) !!}
	    {!! Form::submit('Search',
	                    array('class'=>'btn btn-default')) !!}
	 	{!! Form::close() !!}
		<!--end search bar-->
	</div>

	<div class="jumbotron">
		<h1>Manager product</h1>
	</div>

	@if(Session::has('message'))
		<div class="alert alert-info">
			{!! Session::get('message') !!}
		</div>
	@endif
	
	<div class="pull-right">
		<p style="font-weight: bold"> Page {{ $products->currentPage() }} of {{ $products->lastPage() }} </p>
	</div>	

	<!--empty list product-->
	@if (count($products) > 0)
		<table class="table">
		    <thead>
		      <tr>
		        <th>#</th>
		        <th>Name</th>
		        <th>Price</th>
		        <th>Image</th>
		        <th>Description</th>
		        <th>Action</th>
		      </tr>
		    </thead>
		    <tbody>

		    @foreach ($products as $product)
		      <tr>
		        <td>{!! $product->id !!}</td>
		        <td>
		        	<a href="<?php echo URL::to('/product') ?>/{{ $product->id }}">
		        		{!! $product->product_name !!}
		        	</a>
		        </td>
		        <td>
		        	@if (strlen($product->product_image) > 0)
		        		<a href="<?php echo URL::to('/product') ?>/{{ $product->id }}">
					    	<img class="img-product" src="{!! $product->product_image !!}" alt="{!! $product->product_name !!}" width="200" height="150" title="{!! $product->product_name !!}">
					    </a>
					@else 
						<a href="<?php echo URL::to('/product') ?>/{{ $product->id }}">
							<img class="img-product" src="uploads/no-image.png" alt="No image" title="No image" width="200" height="150">
						</a>
					@endif
				</td>
		        <td>{!! $product->product_price !!}</td>
		        <td>{!! $product->product_description !!}</td>
		        <td width="150"><a href="{!! URL::to('/edit/'.$product->id) !!}">Edit</a> | <a href="{!! URL::to('/delete/'.$product->id) !!}" onclick="return checkDel()">Delete</a></td>
		      </tr>
			@endforeach

		    </tbody>
		</table>

		<div class="pull-right">
			<div class="pagination"> {!! $products->render() !!} </div>
		</div>


	@else
	    <h2>Empty product</h2>
	@endif

	

</div>
