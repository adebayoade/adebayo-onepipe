<div class="text-white mt-5">
    <div class="row justify-content-between">
        <form class="mt-5 col-sm-12 col-md-6 form p-3" method="GET" action="{{ route('home.weatherForm') }}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Enter City:</label>
                <input type="text" class="form-control" name="city" required />
            </div>
            <button type="submit" class="w-100 text-white btn btn-primary btn-lg">Find</button>
        </form>

        @if (!empty($data))
            @if ($data['cod'] == '200')
                <div class="col-sm-12 col-md-5 shadow-lg p-5 weather">
                    <div v-if="data" class="d-flex justify-content-between">
                        <div>
                            <h1>{{ $data['name'] }}</h1>
                            <h2>{{ $data['main']['temp'] }} &deg;C</h2>
                            <p>{{ $data['weather'][0]['description'] }}</p>
                            <p>{{ $data['sys']['country'] }}</p>
                            {{-- <p>{{ $getDate }}</p> --}}
                        </div>
                        <div id="icon"><img id="wicon" width="80"
                                src="http://openweathermap.org/img/w/{{ $data['weather'][0]['icon'] }}.png"
                                alt="Weather icon" />
                        </div>
                    </div>
                </div>
            @else
                <div class="col-sm-12 col-md-5 shadow-lg p-5 weather">
                    <div v-if="data" class="d-flex justify-content-between">
                        <div>
                            <h2>City not found</h2>
                            <h2>&deg;C</h2>
                            <p></p>
                            <p></p>
                            {{-- <p>{{ $getDate }}</p> --}}
                        </div>
                        <div id="icon"><img id="wicon" width="80" src="" alt="" />
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
