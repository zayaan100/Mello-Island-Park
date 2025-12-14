<section id="rooms" class="padding-large" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <h3 class="display-3 fw-normal text-center">Our Rooms</h3>

        <div class="row mt-5">

            @foreach($rooms as $room)
            <div class="col-lg-4 mb-4">
                <img src="{{ asset('storage/' . $room->image) }}" class="img-fluid rounded-4">
                <h4 class="mt-3">{{ $room->name }}</h4>
                <p>{{ $room->description }}</p>

                @auth
                <a href="/book/room/{{ $room->name }}" class="btn btn-primary">Book Now</a>
                @endauth
            </div>
            @endforeach

            @if($rooms->isEmpty())
                <p class="text-center">No rooms available.</p>
            @endif

        </div>
    </div>
</section>
