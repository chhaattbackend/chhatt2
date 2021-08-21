@forelse ($areas as $key=>$item)
    <tr class="highlight">
        <td>{{ ++$key }}</td>
        <td>{{ $item->name }}</td>
        <td>
            {{ optional($item->agencies)->count() }}
            {{-- @if ($item->user->agent != null)
                                        {{ optional($item->user->agent)->agency->name }}
                                    @endif --}}
        </td>
        <td>{{ optional($item->properties)->count() }}</td>
        <td>{{ optional($item->leads)->count() }}</td>
        {{-- <td>{{ optional($item->areaTwo)->name }}</td> --}}

    </tr>
@empty
    <p>No Data Found</p>
@endforelse
