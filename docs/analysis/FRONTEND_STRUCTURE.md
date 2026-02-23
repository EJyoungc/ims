# Frontend Structure

- **Base Stack:** Tailwind CSS + Livewire 3 + Alpine.js.
- **Layouts:**
    - `app.blade.php`: The standard authenticated dashboard shell.
    - `guest.blade.php`: Used for login and initial setup.
- **UI Components:** Uses a mix of Blade components (e.g., `button.blade.php`, `modal.blade.php`) and standard HTML templates.
- **Legacy Integration:** Includes static assets for `AdminLTE` templates, `ApexCharts` for data visualization, and `DataTables` for legacy list views.
