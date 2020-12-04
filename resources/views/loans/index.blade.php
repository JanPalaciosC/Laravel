<x-app-layout>
	<x-slot name="header">
		<div class="row">
			<div class="col-8">
				<h2 class="font-semibold text-xl text-light  leading-tight ">
		            {{ __('Loans') }} 
		        </h2>
			</div>
			<div class="col-4">
				<button class="btn btn-danger float-right" data-toggle="modal" data-target="#addLoan">
					<label class="d-none d-sm-inline">Add loan </label> +
		        </button>
			</div>
		</div>
    </x-slot>

    <div class="py-12 bg-dark h-100" style="min-height: 100vh; overflow: hidden;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl">
                <div class="table-responsive">
	            	<table class="table table-striped table-bordered mb-0">
					  	<thead class="thead-dark ">
						    <tr>
						    	<th scope="col">#</th>
						    	<th scope="col">Movie</th>
						    	<th scope="col">Status</th>
						    	<th scope="col">Day loaned</th>
						    	<th scope="col">Returned date</th>
						    	<th scope="col" class="text-right">Actions</th>
						    </tr>
					  	</thead>
						<tbody>
							@if (isset($loans))
							@foreach ($loans as $loan)
							<tr>
								<th scope="row">
									{{ $loan->id }}
								</th>
								<td> 
									@foreach($movies as $movie)
										@if($loan->movie_id == $movie->id)
											{{$movie->title}}
											@break
										@endif
									@endforeach
								</td>
								<td> {{ $loan->status }} </td>
								<td> {{ substr($loan->created_at, 0, 10) }} </td>
								<td> 
									@if($loan->created_at == $loan->updated_at)
										Not returned
									@else
										{{ substr($loan->updated_at, 0, 10) }}
									@endif
								</td>
								<td class="text-right">
									<div class="btn-group" role="group" aria-label="Button group with nested dropdown"> 

									@if($loan->status === 'active')
										<a onclick="movieReturn({{$loan->id}})" class="btn btn-warning w-100 align-middle">Return</a>
								    @endif
								</div>
								</td>
								</tr> 
							@endforeach
							@endif 
						</tbody>
					</table>
				</div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="editLoan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Update loan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="{{ url('loans') }}" >
	      			@csrf
	      			@method('PUT')
					<div class="modal-body">
						<div class="form-group">
							<label class="my-1 mr-2" for="movie_id">Movie</label>
							<select class="custom-select my-1 mr-sm-2" id="movie_id">
								@foreach($movies as $movie)
								<option value="{{$movie->id}}">{{$movie->title}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="my-1 mr-2" for="status">Status</label>
							<select class="custom-select my-1 mr-sm-2" id="status">
								<option value="active">active</option>
								<option value="closed">closed</option>
							</select>
						</div>
		    		</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Cancel
						</button>
						<button type="submit" class="btn btn-primary">
							Update data
						</button>
						<input type="hidden" name="id" id="id" >
					</div>
	    		</form>
			</div>
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

     	function edit(id,movie,status){
			$("#movie_id option[value='"+movie+"']").attr("selected",true)
			$("#status option[value='"+status+"']").attr("selected",true)
			$("#id").val(id)
     	}
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
	              	console.log(response);
	                if (response.status===200) 
	                {
	                  swal( response.data.message , {
	                    icon: "success",
	                  }).then((accept)=> {
	                  	if (accept) {
	                  		location.reload();
	                  	}

	                  });
	                  
	                }
	                else
	                {
	                  swal( response.data.message , {
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