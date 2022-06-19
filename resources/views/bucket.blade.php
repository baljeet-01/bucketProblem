<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Buckets</title>
</head>
<body>
	<div>
	  <div>
	    <p>
	      <strong>Inputs</strong>
	    </p>
	  </div>
	  <hr />

	  <form  action="/bucketCalculation" method="post">
	  	 @csrf
  		@if(!session()->has('empty_space'))
	  	<div>
		    <p><strong>Add the volume of the Bucket:</strong></p>
		    <div>
		      <label for="bucketA">
		        A
		      </label>
		      <input type="text" name="bucketA" id="bucketA" />
		    </div>
		    <div>
		      <label for="bucketB">
		        B
		      </label>
		      <input type="text" name="bucketB" id="bucketB" />
		    </div>
		    <div>
		      <label for="bucketC">
		        C
		      </label>
		      <input type="text" name="bucketC" id="bucketC" />
		    </div>
		    <div>
		      <label for="bucketD">
		        D
		      </label>
		      <input type="text" name="bucketD" id="bucketD" />
		    </div>
		    <div>
		      <label for="bucketE">
		        E
		      </label>
		      <input type="text" name="bucketE" id="bucketE" />
		    </div>
	  		
	  	</div>
	  	<div>
		    <p><strong>Add the volume of the Balls:</strong></p>
		    <div>
		      <label for="Pink">
		        Pink
		      </label>
		      <input type="text" name="pink" id="Pink" />
		    </div>
		    <div>
		      <label for="Red">
		        Red
		      </label>
		      <input type="text" name="red" id="Red" />
		    </div>
		    <div>
		      <label for="Blue">
		        Blue
		      </label>
		      <input type="text" name="blue" id="Blue" />
		    </div>
		    <div>
		      <label for="Orange">
		        Orange
		      </label>
		      <input type="text" name="orange" id="Orange" />
		    </div>
		    <div>
		      <label for="Green">
		        Green
		      </label>
		      <input type="text" name="green" id="Green" />
		    </div>
	  		
	  	</div>

	  	<div>
		    <p><strong>Input the number of each colored ball to be placed inside the buckets::</strong></p>
		    <div>
		      <label for="APink">
		        Pink
		      </label>
		      <input type="text" name="npink" id="APink" />
		    </div>
		    <div>
		      <label for="BRed">
		        Red
		      </label>
		      <input type="text" name="nred" id="BRed" />
		    </div>
		    <div>
		      <label for="CBlue">
		        Blue
		      </label>
		      <input type="text" name="nblue" id="CBlue" />
		    </div>
		    <div>
		      <label for="DOrange">
		        Orange
		      </label>
		      <input type="text" name="norange" id="DOrange" />
		    </div>
		    <div>
		      <label for="EGreen">
		        Green
		      </label>
		      <input type="text" name="ngreen" id="EGreen" />
		    </div>
	  		
	  	</div>
	  	@else
	  		<div>
	  			<p>
	  				Volume of balls and buckets cannot be changed. Destroy the session to start fresh or resubmit again to get result for same batch again.
	  			</p>
	  		</div>
	  	@endif
	  	<input type="submit" name="submit" value="submit">
	  	<a href="/destorySession">Destroy Session</a>
	  </form>
	</div>
	<div>
		<div>
	    <p>
	      <strong>Output</strong>
	    </p>
	  </div>
	  <hr />
	  <div>
	  	@if(isset($output) && $output)
	  		@foreach($output as $key=>$value)
	  			{{$key}} : {{$value}} <br>
	  		@endforeach

	  		Minimum {{count($output)}} Buckets required <br>
	  	@endif
	  	@if(isset($filled_space) && $filled_space)
	  		{{$filled_space}} cubic inches of bucket is used to put balls <br>
	  	@endif
	  	@if(isset($left_out_ball_volume) && $left_out_ball_volume)
	  		{{$left_out_ball_volume}} cubic inches of bucket required to put remaining of balls
	  	@endif
	  </div>
	</div>
</body>
</html>