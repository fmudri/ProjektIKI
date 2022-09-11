<!--Omogućava korištenje x-card, u $attr merga sve klase koje mu se dodjele-->
<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}>
    {{$slot}}
</div>