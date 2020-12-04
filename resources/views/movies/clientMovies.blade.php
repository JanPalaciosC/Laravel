<x-app-layout>
	<x-slot name="header">
		<div class="row">
			<div class="col-8">
				<h2 class="font-semibold text-xl text-light leading-tight ">
		            {{ __('Movies') }} 
		        </h2>
			</div>
		</div>
    </x-slot>

    <div class="py-12 bg-dark h-100" style="min-height: 100vh; overflow: hidden;">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 row flex-wrap">
        	@if (isset($movies))
			@foreach($movies as $movie)
				<div class="card col-12 col-md-4 col-lg-3 border-dark p-0" style="width: 18rem;">
					<div style="height: 200px;" class="card-body w-100 p-0 text-center">
						<img class="card-img-top" style="height: 200px;" src="img/{{$movie->cover}}" alt="Card image cap">
					</div>

					<div class="card-body">
						<h5 class="mt-1">{{$movie->title}}</h5>
						<p>Summary:<br>{{$movie->description}}</p>
						<h5>From: {{$movie->year}}</h5>
						<h5>{{$movie->clasification}} </h5>
						<h5>{{$movie->minutes}}mins</h5>
					</div>
					<div class="card-footer p-0">
						@if(isset($myloans) && count($myloans)>0)
						@foreach($myloans as $loan)
							@if($loan->movie_id === $movie->id && $loan->status === 'active')
						        <button disabled style="border-top-left-radius:0px!important;border-top-right-radius:0px!important;" class="btn btn-secondary w-100 h-100 rounded-0">Already got it</button>
								@break
							@elseif($loop->last)
								<a onclick="takeMovie({{$movie->id}},{{Auth::user()->id}})"style="border-top-left-radius:0px!important;border-top-right-radius:0px!important;" class="btn btn-danger w-100 h-100 rounded-0">Take this one</a>
						    @endif
						@endforeach
						@else
							<a onclick="takeMovie({{$movie->id}},{{Auth::user()->id}})"style="border-top-left-radius:0px!important;" class="btn btn-danger w-100 h-100 rounded-0">Take this one</a>
						@endif
					</div>
				</div>
			@endforeach
			@endif 
        </div>
    </div>

	
	<x-slot name="scripts">
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">

     	function takeMovie(movieid,userid)
		{
	        swal
	        ({
	            title: "Are you sure?",
	            text: "You want this one?",
	            icon: "warning",
	            buttons: true,
	            dangerMode: true,
	        })
	        .then((returned) => {
	            if (returned) 
	            { 
	              axios.post('{{ url('loans') }}/', {
	                _token: '{{ csrf_token() }}',
	                user_id: userid,
	                movie_id: movieid
	              })
	              .then(function (response) 
	              { 
	              	console.log(response);
	                if (response.status===200) 
	                {
	                  swal( "Your movie is ready", {
	                    icon: "success",
	                  }).then((ok)=>{
	                  	if(ok){
	                  		location.reload();
	                  	}
	                  });
	                }
	                else
	                {
	                  swal( "An error has ocurred in a few minutes", {
	                    icon: "error",
	                  });
	                }
	              });
	              
	            }
	        });
		}
     </script>
    </x-slot>
</x-app-layout>