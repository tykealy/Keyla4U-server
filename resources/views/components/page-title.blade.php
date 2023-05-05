@props(['title'])
<div>
    <h1 {{ $attributes->merge(['class' => 'text-danger fw-bold m-2 ms-0 text-uppercase']) }}>
        {{$title}}
    </h1>
</div>