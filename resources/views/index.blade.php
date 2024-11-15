@extends('layouts.app')

@section('container')
    <?php if(Request::is('/')) : ?>
    @livewire('index')
    <?php endif ?>
@endsection 
