@php
$cnt =1;
@endphp
@foreach($itemOrden as $item)

    @include("Components/trDetalleGuia")

    @php
    $cnt = $cnt+1;
    @endphp
@endForEach