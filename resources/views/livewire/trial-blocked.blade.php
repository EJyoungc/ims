<div class="container mt-5">
    <div class="card border-danger">
        <div class="card-body text-center">

            <h3 class="text-danger">
                🚫 Trial Tampering Detected
            </h3>

            <p>
                Trial permanently disabled on this machine.
            </p>

            <hr>

            <input type="password"
                   class="form-control mb-2"
                   placeholder="Enter restore code"
                   wire:model.defer="restoreCode">

            @error('restoreCode')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <button wire:click="restoreTrial"
                    class="btn btn-warning mt-2">
                Restore Trial
            </button>

            @if (session()->has('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>
</div>
