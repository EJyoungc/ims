# Services and Workflows

- **LicenseVerifier Service:** Static utility that decodes base64-encoded license strings and verifies the RSA signature using `openssl_verify`. It also validates the local `machine_id` and expiration dates.
- **Audit Logging Workflow:** Granular logging is manually triggered within Livewire methods to capture specific actions (e.g., `addItemToCart`, `pay`, `store`).
- **Inventory Workflow:** Stock levels are adjusted immediately upon transaction completion in `POSLivewire` and upon inventory status updates in `PurchaseLivewire`.
