@extends('email.root')
@section('Content')
<div class="container">
    <div>
        <h1>Aktivasi Anggota Baru</h1>
        <p class="p">Anggota baru telah terdaftar perlu diaktivasi</p>
    </div>
    <span></span>
    <table>
        <tbody>
            <td>Nama</td>
            <td>: {{ $nama }}</td>
        </tbody>
        <tbody>
            <td>Stasi</td>
            <td>: {{ $stasi }}</td>
        </tbody>
        <tbody>
            <td>Email</td>
            <td>: {{ $email }}</td>
        </tbody>
        <tbody>
            <td>Waktu Daftar</td>
            <td>: {{ $waktu }}</td>
        </tbody>
    </table>
</div>
@endsection
