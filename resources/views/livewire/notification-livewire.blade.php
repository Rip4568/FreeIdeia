<div class="dropdown dropdown-end">
    <div tabindex="0" role="button" class="m-1">
      <button class="btn btn-ghost">
        <div class="indicator">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
        @if (Auth::check())
          <span class="badge badge-xs badge-primary indicator-item">{{ $user->notifications->count() }}</span>
        @endif
      </div>
    </button>
  </div>
<ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 max-h-screen notifications">
    <li class="fa fa-bell-slash"><a href="{{ route('notificaions.clear') }}" class="btn btn-sm btn-outline btn-primary">limpar tudo</a></li>
    @foreach($notifications as $notification)
        <li>
            <div class="collapse bg-base-200">
                <input type="radio" name="my-accordion">
                <div class="collapse-title text-xl font-medium">{{ $notification->title }}</div>
                <div class="collapse-content">
                    <p>{{ $notification->message }}</p>
                    <button wire:click="deleteNotification({{ $notification->id }})"
                     class="btn btn-sm btn-accent btn-circle absolute bottom-1 right-1 mouse-pointer">x</button>
                </div>
            </div>
        </li>
    @endforeach
</ul>
