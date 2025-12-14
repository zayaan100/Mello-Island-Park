<section id="spa" class="padding-large" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <h3 class="display-3 fw-normal text-center">Spa & Wellness</h3>

        <div class="row mt-5">

            @foreach($spaItems as $spa)
            <div class="col-lg-4 mb-4">
                <img src="{{ asset('storage/' . $spa->image_path) }}" class="img-fluid rounded-4">
                <h4 class="mt-3">{{ $spa->name }}</h4>
                <p>{{ $spa->description }}</p>

                @auth
                <a href="/book/spa/{{ $spa->name }}" class="btn btn-primary">Book Now</a>
                @endauth
            </div>
            @endforeach

            @if($spaItems->isEmpty())
                <p class="text-center">No spa services available.</p>
            @endif

        </div>
    </div>
</section>
