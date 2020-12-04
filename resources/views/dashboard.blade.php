<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-light text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-dark h-100" style="min-height: 100vh; overflow: hidden;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg row">
                <div class="col-sm-6 my-5 text-center">
                    <h5 >Most taken <span id="currentDay"></span></h5>
                    <canvas id="myChart" ></canvas>
                </div>
                <div class="col-sm-6 my-5">
                    <h5 >Most taken all time</h5>
                    <canvas id="myChart1" ></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        
        var ctx = document.getElementById('myChart');
        var ctx = document.getElementById('myChart').getContext('2d');
        var loans = {!!$loans!!};
        var movies = {!!$movies!!};
        var moviesCount = [];
        var count = 0;
        var newdate = new Date();
        newdate = newdate.toJSON().split('T')[0];
        var showdate = document.getElementById('currentDay');
        showdate.innerHTML = newdate;
        movies.forEach(function(movie){
            moviesCount[count] = 0;
            loans.forEach(function(loan){
                    console.log(loan.created_at.split('T')[0],newdate);
                if (movie.id == loan.movie_id && loan.created_at.split('T')[0] == newdate) {
                    moviesCount[count]++;
                }
            });
            count++;
        });
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@foreach($movies as $movie)
                            '{{$movie->title}}',
                            @endforeach],
                datasets: [{
                    label: '',
                    data: moviesCount,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255,0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script> 
    <script>
        var ctx = document.getElementById('myChart1');
        var ctx = document.getElementById('myChart1').getContext('2d');
        var loans = {!!$loans!!};
        var movies = {!!$movies!!};
        var moviesCount = [];
        var count = 0;
        movies.forEach(function(movie){
            moviesCount[count] = 0;
            loans.forEach(function(loan){
                if (movie.id == loan.movie_id) {
                    moviesCount[count]++;
                }
            });
            count++;
        });
       /* var pie = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: "Car Speed",
                    data: moviesCount,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }],
                labels: [@foreach($movies as $movie)
                            '{{$movie->title}}',
                            @endforeach
                    ],
            }
            ,
            options: {
                legend: {
                        display: true,
                        position: 'top',
                        labels: {
                        boxWidth: 80,
                        fontColor: 'black'
                    }
                }
            }

        });*/
        var speedData = {
          labels: [@foreach($movies as $movie)
                    '{{$movie->title}}',
                    @endforeach],
          datasets: [{
            label: "",
            data: moviesCount,
            pointBorderWidth: 10,
            pointBorderColor:[
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
            ]
          }]
        };
        var chartOptions = {
          legend: {
            display: true,
            position: 'top',
            labels: {
              boxWidth: 80,
              fontColor: 'black'
            }
          }
        };
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: speedData,
            options: chartOptions
        });
    </script>  
</x-app-layout>
