<div>
    <!--  notifications icon in header page  -->
    @if ($unreadnotifications_count > 0)
        <span class="badge notification-badge">{{ $unreadnotifications_count }}</span>
    @endif
</div>
