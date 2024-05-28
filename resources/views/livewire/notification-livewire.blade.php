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
