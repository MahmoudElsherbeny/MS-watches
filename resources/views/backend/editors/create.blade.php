@extends('backend.layouts.app')
@section('title') Dashboard | Editors @endsection

@section('content')

<!-- Create Editor Form -->
<div class="card">
    <div class="card-header">
        <h4 class="text-capitalize">Create Editor</h4>
    </div>

    <div class="card-block">
        <!--  create new editor form   -->
        @livewire('backend.editor.create')
    </div>

</div>
<!-- End Create Editor Form -->

@endsection