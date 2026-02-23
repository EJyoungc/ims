<div>
    <div class="min-vh-100 w-100 d-flex align-items-center justify-content-center">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card shadow">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Software <span wire:click="resetAll"    wire:confirm.prompt="Are you sure?\n\nType RESET to confirm|RESET"
 > License </span> </h5>
                        </div>

                        <d class="card-body">
                            <div class="d-flex">
                                {{-- <button wire:click="resetAll" class="d-none w-100 btn btn-sm btn-danger">
                                Reset License / Trial (DEV) <x-spinner for="resetAll" /> --}}
                            </button>
                            </div>
                            {{-- STATUS ALERTS --}}
                            @if ($status === 'active')
                                <div class="alert alert-success">
                                    ✅ License Active
                                    @if ($daysRemaining)
                                        <br>Expires in {{ $daysRemaining }} days
                                    @endif
                                </div>
                            @elseif($status === 'trial')
                                <div class="alert alert-warning">
                                    🧪 Trial Mode <br>
                                    {{ $daysRemaining }} days remaining
                                </div>
                            @elseif($status === 'expired')
                                <div class="alert alert-danger">
                                    ❌ Trial Expired <br>
                                    Please purchase a license
                                </div>
                            @elseif($status === 'tampered')
                                <div class="alert alert-danger">
                                    🚫 Trial Tampering Detected <br>
                                    Trial permanently disabled
                                </div>
                            @else
                                {{-- <div class="alert alert-danger">
                                    ❌ Invalid License
                                </div> --}}
                            @endif

                            {{-- MACHINE ID --}}
                            <div class="mb-3">
                                <label class="fw-bold">Machine ID</label>
                                <textarea class="form-control" rows="2" readonly>{{ $machineId }}</textarea>
                            </div>

                            {{-- LICENSE INPUT (PAID) --}}
                            @if (in_array($status, ['trial', 'expired','active', 'none']))
                                <div class="mb-3">
                                    <label class="fw-bold">License Key</label>
                                    <textarea wire:model.defer="licenseKey" class="form-control" rows="4" placeholder="Paste license key here"></textarea>
                                </div>


                                <button wire:click="activate" class="btn btn-sm btn-primary">
                                    Activate License <x-spinner for="activate" />
                                </button>
                            @endif

                            {{-- START TRIAL BUTTON --}}
                            @if ($status === 'none')
                                <button wire:click="startTrial" class="btn btn-sm btn-warning">
                                    Start Trial <x-spinner for="startTrial" />
                                </button>
                            @endif

                            {{-- END TRIAL BUTTON --}}
                            @if ($status === 'trial' || $status === 'active')
                                <a href="{{ route('login') }}"  class="btn btn-sm btn-success">
                                    Login
                                </a>
                            @endif

                            {{-- RESET BUTTON (DEV / ADMIN) --}}




                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
