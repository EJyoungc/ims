# Application Workflow

1.  **System Initialization:** User completes `/setup` to initialize the first system admin.
2.  **License Activation:** Admin provides a license key; `LicenseVerifier` validates the machine and signature.
3.  **Cataloging:** Users populate `Categories` and `Products` via reactive CRUD forms.
4.  **Procurement:** `Purchases` are recorded from `Suppliers`, which increments `Product` quantities.
5.  **Retail Transaction:** Clerk uses `POSLivewire` to search products, build a cart, and process payment.
6.  **Reporting:** Owners view `ReportProfitLivewire` to see financial performance based on sales and recorded expenses.
