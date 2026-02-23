# Livewire Components

Livewire components serve as the primary containers for business logic and UI state.

- **POSLivewire:** 
    - *Logic:* Handles real-time cart state, AJAX-like product searches with `Cache` support, and stock availability validation.
    - *Features:* Integrated customer creation modals and calculation of change during payment.
- **ProductLivewire:** Manages inventory CRUD, including barcode validation and threshold-based stock alerts.
- **ReportProfitLivewire:** Aggregates `sales` and `expenses` data to calculate net margins over specific date ranges.
- **LicenseManagerLivewire:** Manages the activation of the application via local RSA key verification and machine ID binding.
- **LivewireUsers:** Handles role assignments and user account lifecycle management.
