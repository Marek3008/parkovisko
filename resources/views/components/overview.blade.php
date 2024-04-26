<div {{$attributes->class(['overview'])}} @style(['overflow-y: scroll' => $numOfElements > $maxElements])>
    {{ $slot }}
</div>