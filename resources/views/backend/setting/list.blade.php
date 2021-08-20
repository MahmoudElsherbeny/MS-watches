@extends('backend.layouts.app')
@section('title') Dashboard | Setting @endsection

@section('content')

    <!-- Setting Table -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-a-0 m-t-xs">Setting (<span>{{count($settings)}}</span>)</h4>
                </div>
            </div>
        </div>
        <div class="card-block">
            <table class="table table-striped table-vcenter js-dataTable-simple">
                <thead>
                    <tr>
                        <th class="text-center w-5">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Value</th>
                        <th class="text-center">Last Update</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($settings as $key=>$setting)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center text-capitalize">{{ $setting->name }}</td>
                            <td class="text-center">{{ $setting->value }}</td>
                            <td class="text-center">{{ $setting->updated_at->format("Y-m-d g:i a") }}</td>
                        </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
        <!-- .card-block -->
    </div>
    <!-- End Setting Table -->
    
@endsection