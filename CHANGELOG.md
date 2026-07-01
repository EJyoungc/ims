# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.8] - 2026-07-01
### Added
- Redesigned the Login interface with a premium dark glassmorphic theme,Outfit font, ambient glow lights, and custom animations.
- Redesigned all Setup views (User Setup, Database Manager, and License Manager) to match the dark glassmorphic login theme.
- Added custom SQLite database path connections and dynamic `.env` updating in the Database Manager.
- Added the Database Manager menu shortcut to the NativePHP Help menu inside `NativeAppServiceProvider.php`.

### Fixed
- Fixed the Livewire missing root tag exception inside the `licence-expire-date-liviwire` component by ensuring the root `<li>` tag is always rendered (hidden via `display: none` when empty).
- Fixed the duplicate class registration conflict by purging the empty duplicate `app/Livewire/DashboardLivewire.php` class.
- Cleared structural HTML issues in the main dashboard view.

## [1.0.5] - 2025-12-11
### Added
- Added search functionality to the sales page.
- Added a "Create New Sale" button and modal to the sales page.
- Added a "Show/Hide Profit" button to the sales page to conditionally display the profit column.

### Changed
- The "Edit Sale" functionality is now a modal.
- The daily sales summary now reflects the total of the filtered sales.

### Fixed
- Made the tables in the sales page responsive.

## [1.0.4] - 2025-12-09
### Fixed
- Fixed a bug where updating a product's creation and update was fixed .



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