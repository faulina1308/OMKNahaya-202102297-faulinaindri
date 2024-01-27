@extends('email.root')
@section('Content')
<div class="container">
    <div>
        <h1>Peningat Kegiatan</h1>
        <p class="p">Hai {{ $nama }}, besok kamu ada kegiatan {{ $kegiatan }} loh</p>
    </div>
    <span></span>
    <div>
        {!! $deskripsi !!}
    </div>
</div>
@endsection
