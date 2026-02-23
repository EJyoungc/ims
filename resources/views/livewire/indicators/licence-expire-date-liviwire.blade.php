@if ($expiresAt)
    <li class="nav-item d-flex align-items-center px-2" x-data="licenseCountdown('{{ $expiresAt }}', '{{ $type }}')" x-init="start()">
        <a href="{{ route('license.manager') }}">
            <span class="badge" :class="badgeClass">
                <i class="fas fa-clock mr-1"></i>
                <span x-text="label"></span>
            </span>
        </a>
        <script>
            function licenseCountdown(expiresAt, type) {
                return {
                    expires: new Date(expiresAt),
                    label: '',
                    badgeClass: 'badge-success',

                    start() {
                        this.update();
                        setInterval(() => this.update(), 1000);
                    },

                    update() {
                        const now = new Date();
                        let diff = Math.max(0, this.expires - now);

                        const days = Math.floor(diff / 86400000);
                        const hours = Math.floor((diff % 86400000) / 3600000);
                        const minutes = Math.floor((diff % 3600000) / 60000);

                        this.label =
                            (type === 'trial' ? 'Trial: ' : 'License: ') +
                            `${days}d ${hours}h ${minutes}m`;

                        if (days <= 3) {
                            this.badgeClass = 'badge-danger';
                        } else if (days <= 7) {
                            this.badgeClass = 'badge-warning';
                        }
                    }
                }
            }
        </script>
    </li>
@endif
