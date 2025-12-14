<section id="activities" class="padding-large" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <h3 class="display-3 fw-normal text-center">Island Activities</h3>

        <div class="row mt-5">

            @foreach($activities as $activity)
            <div class="col-lg-4 mb-4">
                <img src="{{ asset('storage/' . $activity->image) }}" class="img-fluid rounded-4">
                <h4 class="mt-3">{{ $activity->name }}</h4>
                <p>{{ $activity->description }}</p>

                @auth
                <a href="/book/activity/{{ $activity->name }}" class="btn btn-primary">Book Now</a>
                @endauth
            </div>
            @endforeach

            @if($activities->isEmpty())
                <p class="text-center">No activities available.</p>
            @endif

        </div>
    </div>
</section>
