@extends('frontend.layouts.app')
@section('title')  {{ Auth::user()->name }} @endsection

@section('content')

<!-- Start Contact Area -->
<section class="htc__profile__area">

    <div class="profile__container bg__white">
        <!--  profile header  -->
        <div class="profile__header">
            <div class="cover" style="background: rgba(0, 0, 0, 0) @if($user->user_info && $user->user_info->cover !=null) url(../../storage/{{ $user->user_info->cover }}) @else url(../../frontend/images/avatars/cover.jpg) @endif no-repeat scroll center center / cover ;"></div>
            <div class="image">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                        <div class="profile__image">
                            <img src="@if($user->user_info && $user->user_info->image !=null) {{ asset('storage/'.$user->user_info->image) }} @else {{ asset('frontend/images/avatars/profile_avatar.png') }} @endif" />
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                        <div class="user__name">
                            {{ $user->name }}
                            <a href="{{ route('UserProfile.edit', ['id' => Auth::user()->id, 'name' => Auth::user()->name]) }}"><i class="fa fa-pencil"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  profile content  -->
        <div class="profile__content">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="mini__card">
                        <div class="title text-capitalize mb--10">orders</div>
                        <div class="data">
                            <span>#</span>
                            <span>25</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="mini__card">
                        <div class="title text-capitalize mb--10">rates</div>
                        <div class="data">
                            <span>#</span>
                            <span>25</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="mini__card">
                        <div class="title text-capitalize mb--10">reviews</div>
                        <div class="data">
                            <span>#</span>
                            <span>250</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection

@section('copyright')
    @include('frontend.layouts.copyright')
@endsection