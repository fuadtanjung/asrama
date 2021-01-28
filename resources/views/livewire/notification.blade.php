<div>
<input wire:poll.5000ms="updateNotif" hidden>

<div>
    <li class="nav-item dropdown no-caret d-none d-sm-block mr-3 dropdown-notifications">
        <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i>
            @if($postingan -> count() > 0)
            <span class="badge badge-danger badge-pill" style="font-size: 50%;">{{ $notif }}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
            <h6 class="dropdown-header dropdown-notifications-header">
                <i class="mr-2" data-feather="bell"></i>
               Notifikasi
               <a wire:click='halaman' style="color: white;margin-left: 40%;cursor: pointer"> View All</a>
            </h6>
            @if ($postingan->count() == 0)
            <a class="dropdown-item dropdown-notifications-item">
                <div class="dropdown-notifications-item-icon bg-success"><i class="fa fa-info"></i></div>
                <div class="dropdown-notifications-item-content">
                    <div class="dropdown-notifications-item-content-details"></div>
                    <div class="dropdown-notifications-item-content-text">Tidak Ada Notifikasi</div>
                </div>
            </a>
            @else
                @foreach ($postingan as $item)
                <a class="dropdown-item dropdown-notifications-item">
                    <div class="dropdown-notifications-item-icon bg-success"><i class="fa fa-info"></i></div>
                    <div class="dropdown-notifications-item-content">
                        <div class="dropdown-notifications-item-content-details">{{ $item->waktu_post }}</div>
                        <div class="dropdown-notifications-item-content-text">{{ $item->judul }}</div>
                    </div>
                </a>
                 @endforeach
            @endif
        </div>
    </li>
</div>
</div>
