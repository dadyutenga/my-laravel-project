# CRUSH.md

## Build, Lint, and Test Commands
- **Build**: `php artisan build` - Builds the Laravel application.
- **Lint**: `php artisan lint` - Checks code style (assumed command, adjust if different).
- **Test**: `php artisan test` - Runs the full test suite using PHPUnit.
- **Single Test**: `php artisan test --filter=TestClassName::testMethod` - Runs a specific test method.

## Code Style Guidelines
- **Imports**: Group by type (standard, third-party, local) with alphabetical ordering within groups.
- **Formatting**: Follow PSR-12 standards; use 4-space indentation, no trailing whitespace.
- **Types**: Use strict typing (`declare(strict_types=1)`); explicitly type function parameters and returns.
- **Naming Conventions**: Use CamelCase for class names, snake_case for variables and methods.
- **Error Handling**: Use try-catch blocks for exceptions; log errors with Laravel's logging system.
- **File Structure**: Follow Laravel conventions (e.g., controllers in `app/Http/Controllers`).
- **Comments**: Use PHPDoc for functions/classes; avoid inline comments unless clarifying complex logic.

## Codebase Structure
- **app/**: Core application logic (Models, Controllers, Middleware).
- **resources/views/**: Blade templates for UI.
- **database/migrations/**: Database schema definitions and updates.
- **routes/**: API and web route definitions.

## Additional Notes
- Ensure all new code adheres to Laravel's built-in security practices (e.g., CSRF protection).
- Use Laravel's built-in tools for authentication (e.g., Sanctum for APIs).
