<div class="dropdown nav-item main-header-notification">
    <a class="new nav-link" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
        <span class="pulse"></span>
            <span class="not-read">{{$noReadNotificationCount}}</span>
    </a>
    <div class="dropdown-menu">
        <div class="menu-header-content bg-primary">
            <div class="d-flex">
                <h6 class="dropdown-title mb-1 tx-15 mr-5 text-white font-weight-semibold">Notifications</h6>
                {{-- <span class="badge badge-pill badge-warning ml-5  my-auto float-left">Mark All Read</span> --}}
            </div>
            <p class=" subtext mb-0 text-white op-6 pb-0 tx-12 ">You have {{$noReadNotificationCount}} unread Notifications</p>
        </div>
        <div class="main-notification-list Notification-scroll">
            @forelse ($noReadNotifications as $noReadNotification)
            <a class="d-flex p-3 border-bottom" wire:click="markAsRead('{{ $noReadNotification->id }}')" style="cursor: pointer">
                <div class="notifyimg bg-pink">
                    <i class="la la-file-alt text-white"></i>
                </div>
                <div class="ml-3">
                    <h5 class="notification-label mb-1">the new order with amount {{$noReadNotification->data['amount']}} from {{$noReadNotification->data['customer_name']}}</h5>
                    <div class="notification-subtext">{{$noReadNotification->data['created_date']}}</div>
                </div>
                <div class="mr-auto" >
                    <i class="las la-angle-left text-right text-muted"></i>
                </div>
            </a>
            @empty
                <p class="text-center">No Found Notification</p>
            @endforelse
        </div>
    </div>
</div>
