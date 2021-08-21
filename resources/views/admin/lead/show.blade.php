@extends('layouts.app')
@section('content')
<form action="{{route('properties.search')}}" method="get">
    <select name="search_areas" id="">
        @foreach ($areaones as $item)
        <option value="area_one_id,{{$item->id}}">{{$item->name}} - {{$item->city->name}}</option>
        @endforeach
        @foreach ($areatwos as $item)
        <option value="area_two_id,{{$item->id}}">{{$item->area_one->name}} {{$item->name}} - {{$item->area_one->name}},{{$item->area_one->city->name}}</option>
        @endforeach
        @foreach ($areathrees as $item)
        <option value="area_three_id,{{$item->id}}">{{$item->name}} - {{$item->area_two->name}},{{$item->area_one->name}},{{$item->area_one->city->name}}</option>
        @endforeach
    </select>
    <button>Submit</button>
</form>
@endsection
