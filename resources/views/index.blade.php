<x-app-layout>
    <x-slot name="header">
		<div class="row">
			<div class="col-8">
				<h2 class="font-semibold text-xl text-gray-800  leading-tight ">
		            {{ __('Movies') }} 
		        </h2>
			</div>
			<div class="col-4">
				<button class="btn btn-primary float-right" data-toggle="modal" data-target="#addMovie">		        	
		        	<label class="d-none d-sm-inline">Add Movie </label> +
		        </button>
			</div>
		</div>  
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl ">
            	<div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Title</th>
							<th scope="col">Clasification</th>
							<th scope="col">Category</th>
							<th scope="col" class="text-right">Actions</th>
						</tr>
					</thead>
					<tbody>				 
				    	@if(isset($movies) && count($movies)>0)
				    	@foreach($movies as $movie)
				    	<tr>
					      	<th scope="row">{{ $movie->id }}</th>
					      	<td>{{ $movie->title }}</td>
					      	<td>{{ $movie->clasification }}</td>
					      	<td>{{ $movie->category->name }}</td>
					      	<td class="text-right">
						      	<div class="btn-group" role="group" aria-label="Button group with nested dropdown"> 

								  <div class="btn-group" role="group">
								    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								      Actions
								    </button>
								    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
								      <a data-toggle="modal" onclick="editMovie({{ $movie->id }},this)" data-target="#editMovie" class="dropdown-item" href="#">
								      	Update
								      </a>
								      <a class="dropdown-item" >
								      	Delete
								      </a>
								    </div>
								  </div>
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


	<div class="modal fade" id="addMovie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Add Movie</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

      	<form method="post" action="{{ url('movies') }}" enctype="multipart/form-data">
	      	@csrf 

	      	<div class="modal-body">
		        
	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Title
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="text" class="form-control" placeholder="Title example" aria-label="Title example" aria-describedby="basic-addon1" name="title" required="">
					</div>
				</div>

	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Clasification
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <select class="form-control" name="clasification">
							<option>AA</option>
							<option>A</option>
							<option>B</option>
							<option>B15</option>
							<option>C</option>
							<option>D</option>					  	
					  </select>
					</div>
				 </div>

 	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Category
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <select class="form-control" name="category_id">
					  	@foreach($categories as $category)
							<option value="{{ $category->id }}">
								{{ $category->name }}
							</option>		
						@endforeach			  	
					  </select>
					</div>
				 </div>

 	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Minutes
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="number" class="form-control" placeholder="1234" name="minutes" required="">
					</div>
				</div>

 	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Year
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="number" class="form-control" placeholder="1995" name="year" required="">
					</div>
				</div>

 	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Cover
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="file" class="form-control" name="cover_file" required="">
					</div>
				</div>

	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Trailer
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="text" class="form-control" placeholder="Trailer Example" aria-label="Title example" aria-describedby="basic-addon1" name="trailer" required="">
					</div>
				</div>

				<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Description
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <textarea class="form-control" rows="5" placeholder="description of de category" name="description"></textarea>
					</div>
				</div>

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

	<div class="modal fade" id="editMovie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Edit Movie</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

      	<form method="post" action="{{ url('movies') }}" enctype="multipart/form-data">
	      	@csrf 
	      	@method('PUT');
	      	<div class="modal-body">
		        
	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Title
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="text" class="form-control" placeholder="Title example" aria-label="Title example" aria-describedby="basic-addon1" name="title" id="title" required="">
					</div>
				</div>

	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Clasification
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <select class="form-control" name="clasification" id="clasification">
							<option>AA</option>
							<option>A</option>
							<option>B</option>
							<option>B15</option>
							<option>C</option>
							<option>D</option>					  	
					  </select>
					</div>
				 </div>

 	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Category
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <select class="form-control" name="category_id" id="category_id">
					  	@foreach($categories as $category)
							<option value="{{ $category->id }}">
								{{ $category->name }}
							</option>		
						@endforeach			  	
					  </select>
					</div>
				 </div>

 	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Minutes
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="number" class="form-control" placeholder="1234" name="minutes" id="minutes" required="">
					</div>
				</div>

 	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Year
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="number" class="form-control" placeholder="1995" name="year" id="year" required="">
					</div>
				</div>

 	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Cover
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="file" class="form-control" name="cover_file" id="cover_file">
					</div>
				</div>

	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Trailer
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="text" class="form-control" placeholder="Trailer Example" aria-label="Title example" aria-describedby="basic-addon1" name="trailer" id="trailer" required="">
					</div>
				</div>

				<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Description
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <textarea class="form-control" rows="5" placeholder="description of de category" name="description" id="description"></textarea>
					</div>
				</div>

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
     		
     		function editMovie(id)
     		{
     			axios.get('{{ url('movies') }}/'+id)
     			.then(function (response)
     			{
     				var data = response.data

     				if (data.code ==  200)
     				{
     					var movie = data.data;

     					$('#title').val(movie.title)
     					$('#description').val(movie.description)
						$('#clasification').val(movie.clasification)
						$('#minutes').val(movie.minutes)
						$('#year').val(movie.year)
						$('#trailer').val(movie.trailer)
						$('#category_id').val(movie.category_id)


     				}
     				else
     				{
     					swal(("record not found") {
     						icon: "error",
     					});
     				}
     				console.log(response);
     			})
     			.catch(function (error) {
     				console.log(error);
     			});
     		}
     	
     	</script>
    </x-slot>
</x-app-layout>