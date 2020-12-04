<x-app-layout>
	<x-slot name="header">
		<div class="row">
			<div class="col-8">
				<h2 class="font-semibold text-xl text-ligth  leading-tight ">
		            {{ __('Loans') }} 
		        </h2>
			</div>
		</div>
    </x-slot>

    <div class="py-12 bg-dark h-100" style="min-height: 100vh; overflow: hidden;">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 row flex-wrap">
        	@if (isset($myloans))
			@foreach ($myloans as $loan)
			@if($loan->status!=='inactive')
				<div class="card col-12 col-md-4 col-lg-3 border-0 p-0" style="width: 18rem;">
						@foreach($movies as $movie)
						@if($loan->movie_id == $movie->id)
							<div style="height: 200px;" class="card-body w-100 p-0 text-center">
								<img class="card-img-top" style="height: 200px;" src="img/{{$movie->cover}}" alt="Card image cap">
							</div>

						<div class="card-body">
							<h5 class="mt-1">{{$movie->title}}</h5>
							<p>Summary:<br>{{$movie->description}}</p>
							<h5>From: {{$movie->year}}</h5>
							<h5>{{$movie->clasification}} </h5>
							<h5>{{$movie->minutes}}mins</h5>
							@break
						@endif
						@endforeach
						<h5>Loaned at: {{ substr($loan->created_at, 0, 10) }} </h5>
					</div>
					<div class="card-footer p-0">
						<a onclick="movieReturn({{$loan->id}})"style="border-top-left-radius:0px!important;" class="btn btn-danger w-100 h-100 rounded-0">Return</a>
					</div>
				</div>
			@endif
			@endforeach
			@endif 
        </div>
    </div>
    <div class="modal fade" id="addLoan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
	    		<div class="modal-header">
	        		<h5 class="modal-title" id="staticBackdropLabel">Loan movie</h5>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
			    <form method="POST" action="{{ url('loans') }}" >
			      	@csrf 
			      	@method('POST')
		      		<div class="modal-body">
						<div class="form-group">
							<label class="my-1 mr-2" for="movie_id">Movie</label>
							<select class="custom-select my-1 mr-sm-2" id="movie_id" name="movie_id">
								@foreach($movies as $movie)
								<option value="{{$movie->id}}">{{$movie->title}}</option>
								@endforeach
							</select>
						</div>
						<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			      	</div>
				    <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">
				        	Cancel
				        </button>
				        <button type="submit" class="btn btn-primary">
				        	Save data
				        </button>
				    </div>
			    </form>
			</div>
		</div>
	</div> 

	
	<x-slot name="scripts">
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">

     	function movieReturn(id)
		{
	        swal
	        ({
	            title: "Are you sure?",
	            text: "You can always take it back",
	            icon: "warning",
	            buttons: true,
	            dangerMode: true,
	        })
	        .then((retuned) => {
	            if (retuned) 
	            { 
	              axios.get('{{ url('return') }}/'+id, {
	                _token: '{{ csrf_token() }}'
	              })
	              .then(function (response) 
	              { 
	                if (response.status===200) 
	                {
	                  swal('You can take again at any time' , {
	                    icon: "success",
	                  }).then((ok) => {
	              		console.log(response);
	                  	if (ok) {
	                  		location.reload();
	                  	}

	                  });
	                  
	                }
	                else
	                {
	                  swal( 'An error has ocurred', {
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