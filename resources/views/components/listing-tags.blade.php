@props(['tagsCsv'])


@php
//Turns comma separated value (CSV) into an array and puts it into a variable $tags

//Sve ovo omogućava da se tagovi izvuku iz baze, klikne na njih i da služe kao filter
$tags = explode(',', $tagsCsv);

@endphp
<ul class="flex">
    @foreach ($tags as $tag)
    <li
        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
        <a href="/?tag={{$tag}}">{{$tag}}</a>
        @endforeach
    </li>
</ul>