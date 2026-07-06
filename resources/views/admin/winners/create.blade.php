@extends('layouts.admin')

@section('title', 'Tambah Pemenang')

@section('content')
    <form method="POST" action="{{ route('admin.winners.store') }}" enctype="multipart/form-data" class="admin-card stack-form">
        @csrf
        @include('admin.winners.form')
    </form>
@endsection
