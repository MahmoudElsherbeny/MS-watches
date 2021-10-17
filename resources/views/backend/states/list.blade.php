@extends('backend.layouts.app')
@section('title') Dashboard | States @endsection

@section('content')

    <!-- States Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-a-0 m-t-xs">States (<span>{{count($states)}}</span>)</h4>
                </div>
            </div>
        </div>
        <div class="card-block">
            <!--  states list and update   -->
            @livewire('backend.states.llist')
        </div>
        <!-- .card-block -->
    </div>
    <!-- End States Table -->
    
@endsection