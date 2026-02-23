<li class="nav-item d-flex align-items-center px-2">
    <style>
        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }

            100% {
                opacity: 1;
            }
        }

        .offline-pulse {
            animation: pulse 1s infinite;
        }
    </style>
    <span class="badge bg-light text-dark">

        <i class="fas fa-circle mr-1 text-success offline-pulse  " wire:offline.class="text-danger offline-pulse"
            wire:offline.class.remove="text-success">
        </i>

        <span wire:offline.remove>Online</span>
        <span wire:offline>Offline</span>

    </span>
</li>
