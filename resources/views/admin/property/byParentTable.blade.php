<tr>

    <td>
        {{ $area_one->name }}
    </td>
    {{-- <td>
        @foreach ($area_one->areatwos as $item)
            {{ $item->id }}<br>
        @endforeach
    </td> --}}
    <td>
        @foreach ($area_one->areatwos as $item)
            {{ $item->name }} (<a target="_blank"
                href="{!! route('properties.by_parent', ['area_two' => $item->id]) !!}">{{ count($item->properties) }}</a>)<br>
        @endforeach
    </td>
    {{-- <td>
        @foreach ($areaitem->areatwos as $item)
        @foreach ($item->areathrees as $item1)
            {{$item->name}} <br>
        @endforeach
        @endforeach
    </td> --}}
    <td><a target="_blank" href="{!! route('properties.by_parent', ['area_one' => $area_one->id]) !!}">
            {{ count($area_one->properties) }}
        </a>
    </td>
</tr>
