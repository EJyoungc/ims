# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Created AccessLivewire component and view for unauthorized access display.
- Added '/unauthorized' route for the AccessLivewire component.
- Modified RoleMiddleware to redirect to '/unauthorized' on access denial.

### Changed
- Optimized POS search functionality by allowing results from the first character typed.
- Implemented caching for POS search results (5-minute duration) to improve performance.

## [1.0.3] - 2025-12-07
### Added
- Created an AuditLog Livewire component to display all audit logs with search and filter functionality.

### Changed
- Updated the user edit form to match the create form.
- Removed photo upload functionality from user management.
- Implemented comprehensive audit logging for all relevant Livewire components (Users, Customers, Expenses, Products, Purchases, Returns, Sales, POS, Setup, UserSetup).

### Deprecated
- 

### Removed
- Removed the `purchaseItems` relationship from the `Supplier` model.
- Removed `withCount('purchaseItems')` from `SupplierLivewire`.
- Removed the "Purchases" column from the suppliers list view.

### Fixed
- Fixed a bug preventing the creation of new suppliers. 
- Adjusted colspan for empty row in supplier list view.

### Security
- 
