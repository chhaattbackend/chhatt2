<div>
    @forelse ($leads as $item)

        <tr ondblclick="selectMultiple('{{ $item->id }}')" id="tablerow{{ $item->id }}">
            <input type="checkbox" style="display: none" id="deleterow{{ $item->id }}">
            <td>{{ $item->id }}</td>
            {{-- <td><input id="visitdate{{$item->id}}" type="datetime-local"></td> --}}
            <td>
                @if ($item->response_status == 'Not Interested')

                    <span class="badge badge-pill badge-danger ">Not Interested</span>
                @elseif ($item->visit_date==null)
            {{-- <td> --}}
                <span style="cursor: pointer" id="visit_date{{ $item->id }}"
                    onclick="openVisitModal('{{ $item->id }}')" data-toggle="modal" data-target="#myModal"
                    class="badge badge-pill badge-info">Date Not
                    Set</span><br>
                <span style="display: none" id="visit_date2{{ $item->id }}"
                    class="badge badge-pill badge-success">{{ date('h:i A', strtotime($item->visit_date)) }}</span>
            {{-- </td> --}}

        @elseif ($item->visit_date!=null && $item->response_status != 'Not Interested')
            {{-- <td> --}}

                <span style="cursor: pointer" id="visit_date{{ $item->id }}"
                    onclick="openVisitModal('{{ $item->id }}','{{ strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->visit_date)) }}')"
                    data-toggle="modal" data-target="#myModal"
                    class="badge badge-pill badge-success">{{ date('D, d-m-Y', strtotime($item->visit_date)) }}</span><br>
                <span id="visit_date2{{ $item->id }}"
                    class="badge badge-pill badge-success">{{ date('h:i A', strtotime($item->visit_date)) }}</span>
            {{-- </td> --}}
    @endif

    <span class="badge badge-pill badge-success status{{$item->id}}">@if($item->response_status==null) New Lead @endif {{ $item->response_status }}</span>
    </td>
    {{-- <td class="ani">

    </td> --}}

    <td class="tdname">
        @php
            // $phones = explode(',', optional($item)->phone);
            $phones = explode(',', implode(',', explode('-', optional($item)->phone)));
        @endphp


        <b>Name: </b> <br>
        @if ($item->name == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ $item->name }}
        @endif <br>

        <b>Email: </b> <br>
        @if ($item->email == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ $item->email }}
        @endif <br>



        <b>Phone: </b> <br>
        @foreach ($phones as $item1)
            <a href="https://api.whatsapp.com/send?phone={{ $item1 }}">{{ $item1 }}</a> <br>
        @endforeach
    </td>
    {{-- <td id="rotate{{ $item->id }}" onclick="rotate(180,'rotate{{ $item->id }}')">
                {{ $item->email }}</td> --}}
    {{-- <td>

                    @php
                        $phones = explode('-', optional($item)->phone);

                    @endphp
                    @foreach ($phones as $item1)
                        <a
                            href="https://api.whatsapp.com/send?phone=+92{{ $item1 }}">{{ $item1 }}</a>
                            <br>
                    @endforeach

                </td> --}}
    <td class="tddesc">
        <div class="col-10">
            <textarea readonly class="parent" id="desc{{ $item->id }}" cols="40"
                rows="5">{{ $item->description }}</textarea>
            <svg id="tick{{ $item->id }}" class="checkmark child" style="display: none"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>

        </div>

        <div class="flex">
            <input id="countClick{{ $item->id }}" type="hidden">
            <button id="editdesc{{ $item->id }}" class="btn btn-sm btn-success"
                onclick="editDesc('{{ $item->id }}')">Edit</button>
            <button disabled id="savedesc{{ $item->id }}" class="btn btn-sm btn-primary"
                onclick="saveDesc('{{ $item->id }}')">Save</button>
        </div>

        {{-- <a style="padding-left: 0%"
                                                href="{{ route('leads.edit', $item->id) }}">{{ $item->description }} </a> --}}

    </td>
    <td class="tdbudget">
        Area:
        @if (optional($item->areaOne)->name == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ optional($item->areaOne)->name }}
        @endif <br>

        Budget:
        @if ($item->budget == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ $item->budget }}
        @endif <br>

        Type:
        @if ($item->type == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ $item->type }}
        @endif <br>

        How Soon:
        @if ($item->how_soon == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ $item->how_soon }}
        @endif <br>

        Family:
        @if ($item->family == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ $item->family }}
        @endif <br>

        Leadsource:
        @if ($item->leadsource == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ $item->leadsource }}
        @endif <br>

        Property Type:
        @if ($item->property_type == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ $item->property_type }}
        @endif <br>

        Job Profile:
        @if ($item->job_profile == null)
            <span class="badge badge-pill badge-link">Not Given</span>
        @else
            {{ $item->job_profile }}
        @endif <br>

    </td>
    {{-- <td class="tdtype">{{ $item->type }}</td>
            <td class="tdhowsoon">{{ $item->how_soon }}</td>
            <td class="tdfamily">{{ $item->family }}</td> --}}
    {{-- <td>{{ $item->leadsource }}</td> --}}
    <td> <b>Call Status</b> <br>
        <select style="" onchange="changeCallStatus('{{ $item->id }}')" id="callstatus{{ $item->id }}">
            <option disabled selected value="">Select Call Status</option>
            @foreach ($callstatus as $itemss)
                <option @if ($itemss->name == $item->call_status) selected @endif value="{{ $itemss->name }}">
                    {{ $itemss->name }}</option>
            @endforeach
        </select> <br> <br>
        <b>Response Status</b> <br>
        <select onchange="changeResponseStatus('{{ $item->id }}')" id="responsestatus{{ $item->id }}">
            <option disabled selected value="">Select Response Status</option>
            @foreach ($responsestatus as $itemss)
                <option @if ($itemss->name == $item->response_status) selected @endif value="{{ $itemss->name }}">
                    {{ $itemss->name }}</option>
            @endforeach
        </select> <br> <br>
        <b>Status</b> <br>

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <input id="statusc{{ $item->id }}" type="hidden" class="toggle "
            onclick="statusToggle('{{ $item->id }}')" name="status" value="0">
        <label class="switch">
            <input id="status{{ $item->id }}" @if ($item->status == 1) checked @endif onclick="statusToggle('{{ $item->id }}')" type="checkbox" name="status" value="1">
            <span></span>
        </label>

    </td>
    {{-- <td>
                <select onchange="changeResponseStatus('{{ $item->id }}')" id="responsestatus{{ $item->id }}">
                    <option disabled selected value="">Select Call Status</option>
                    @foreach ($responsestatus as $itemss)
                        <option @if ($itemss->name == $item->response_status) selected @endif value="{{ $itemss->name }}">
                            {{ $itemss->name }}</option>
                    @endforeach
                </select>
            </td> --}}
    {{-- <td>{{ $item->property_type }}</td> --}}
    {{-- <td>

                <div class="col-sm-2">
                    <meta name="csrf-token" content="{{ csrf_token() }}" />

                    <input id="statusc{{ $item->id }}" type="hidden" class="toggle "
                        onclick="statusToggle('{{ $item->id }}')" name="status" value="0">
                    <label class="switch">
                        <input id="status{{ $item->id }}" @if ($item->status == 1) checked @endif onclick="statusToggle('{{ $item->id }}')"
                            type="checkbox" name="status" value="1">
                        <span></span>
                    </label>
                </div>

            </td> --}}


    <td>{{ $item->created_at }}</td>
    <td>{{ $item->updated_at }}</td>
    <td>{{ optional($item->created_by1)->name }}</td>
    {{-- <td>{{ $item->updated_by }}</td> --}}


    <td>
        <a href="{{ route('leads.edit', $item->id) }}" class="float-left"><i class="fas fa-edit"></i></a>
        <form action="{{ route('leads.destroy', $item->id) }}" method="POST">
            @method('delete') @csrf <button class="btn btn-link pt-0 delete-confirm"><i
                    class="fas fa-trash-alt"></i></button> </form>

    </td>
    <td style="display: flex; color: #3B8196;">


        <div class=" ">

            <a class="px-0  " href="{{ route('leadassigns.show', $item->id) }}">
                Users</a>
        </div> &nbsp;|
        <div class="">
            <a class="px-0  " href="{{ route('leadproperties.show', $item->id) }}">
                Properties</a>
        </div>&nbsp;|
        <div class=" ">
            <a class="px-0 " href="{{ route('leadprojects.show', $item->id) }}">
                Projects</a>
        </div>

    </td>
    </tr>


@empty
    <p>No Data Found</p>
    @endforelse
    {{-- @stack('scripts') --}}

</div>



{{-- @push('scripts')
    <script type="text/javascript" src="{{ asset('js/global.js') }}">
     $('.fa-trash-alt').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Your  file has been deleted!", {
                            icon: "success",
                        });
                    }
                });
        });</script>
@endpush --}}
