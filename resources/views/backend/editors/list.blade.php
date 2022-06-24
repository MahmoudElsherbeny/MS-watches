@extends('backend.layouts.app')
@section('title') Dashboard | Editors @endsection

@section('content')

    <!-- Editors Table -->
    <div class="card">
        <!--  Editors list table   -->
        @livewire('backend.editor.editorslist')
    </div>
    <!-- End Editors Table -->
    
@endsection