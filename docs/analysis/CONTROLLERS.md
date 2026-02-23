# Controllers

The application follows a "Livewire-first" approach, utilizing controllers primarily for specific non-reactive utility flows:

- **SecurityQuestionPasswordController:** Implements a custom authentication flow for password resets, bypassing standard email requirements by using stored security questions.
- **ReturnController:** Handles the server-side logic for generating and formatting return transaction receipts for printing.
- **Controller:** Base class containing shared logic for authorization and response handling.
