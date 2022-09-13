{{--Make one layout and use it everywhere--}}
<x-layout>
<!-- Dvostruke vitičaste zamijenjaju php echo -->

@include('partials._hero')
@include('partials._search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

@unless(count($listings) == 0)

<!-- Directives '@' (foreach directive)-->
@foreach ($listings as $listing)
<!--naslov je link prema listingu čiji je id-->
<!--Pristup komponenti listing-card sa "x"-->
<!--Ako predajemo varijablu kao vrijednost, dodajemo ":"-->
<x-listing-card :listing="$listing" />
@endforeach

@else
<p>Nije pronađen niti jedan oglas...</p>
@endunless
</div>
{{--Prikaz paginacije
    ListingController.php--}}
<div class="mt-6 p-4">
    {{$listings->links()}}
</div>

</x-layout>