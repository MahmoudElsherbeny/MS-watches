<div>
    <!--  notifications menu in header page  -->
    @if ($unreadnotifications_count > 0)
        @foreach(App\Admin::find(Auth::guard('admin')->user()->id)->Subnotifications->take(30) as $notify)
            <li class="notification @if(!$notify->read_at) unread @endif">
                <a href="{{ route('AdminNotification.read', ['id' => $notify->id]) }}" class="mark_as_read">
                    <span class="title">{{ $notify->notification->data['title'] }}</span>
                    <span class="description">{{ $notify->notification->data['description'] }}</span>
                    <span class="date">{{ $notify->notification->created_at->diffForHumans() }}</span>
                </a>
            </li>
            <li class="divider"></li>
        @endforeach
        <li class="dropdown-header text-center">
            <a href="{{ route('profile.index', ['id' => Auth::guard('admin')->user()->id, 'name' => Auth::guard('admin')->user()->name]) }}">More...</a>
        </li>
    @endif

</div>
