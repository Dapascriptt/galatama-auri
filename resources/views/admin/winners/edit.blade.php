@extends('layouts.admin')

@section('title', 'Edit Pemenang')

@section('content')
    <form method="POST" action="{{ route('admin.winners.update', $winner) }}" enctype="multipart/form-data" class="admin-card stack-form">
        @csrf
        @method('PUT')
        @include('admin.winners.form')
    </form>
@endsection
