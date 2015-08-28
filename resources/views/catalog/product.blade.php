{!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') !!}
{!! Html::style('css/catalog.css') !!}
{!! Html::script('ckeditor/ckeditor.js') !!}

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Package Product - Laravel 5.1</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="{!! URL::to('/') !!}">Home</a></li>
        <li><a href="{!! URL::to('/products') !!}">List products</a></li>
      </ul>
    </div>
  </div>
</nav>


<div class="container">

	{!! Form::open(array('url' => 'save-product', 'files'=>true)) !!}
	
	<div class="jumbotron">
		<h1>Manager product</h1>
	</div>

	@if(Session::has('message'))
		<div class="alert alert-info">
			{!! Session::get('message') !!}
		</div>
	@endif

	@if ($errors->has())
	    <div class="alert alert-danger">
	        @foreach ($errors->all() as $error)
	            {{ $error }}<br>        
	        @endforeach
	    </div>
    @endif

	<div class="form-group @if ($errors->has('product_name')) has-error @endif">
		{!! Form::label('Product Name *') !!}
		{!! Form::text('product_name', null, array('placeholder'=>'Enter product name ...', 'class' => 'form-control')) !!}
	</div>

	<div class="form-group @if ($errors->has('product_price')) has-error @endif">
		{!! Form::label('Product Price *') !!}
		{!! Form::text('product_price', null, array('placeholder'=>'Enter product price ...', 'class' => 'form-control')) !!}
	</div>

	<div class="form-group">
		{!! Form::label('Product Image') !!}
		{!! Form::file('product_image', null) !!}
	</div>

	<div class="form-group @if ($errors->has('product_description')) has-error @endif">
		{!! Form::label('Product Description *') !!}
		{!! Form::textarea('product_description', null, array('class' => 'form-control', 'id'=>'product_description')) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Create', array('class' => 'btn btn-primary')) !!}
	</div>

	{!! Form::close() !!}

</div>

<script type="text/javascript">
    CKEDITOR.replace('product_description');
</script>
