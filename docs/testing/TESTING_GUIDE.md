# Testing Guide — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Test framework

- PHPUnit 11.5.x (Laravel skeleton). Stock example tests only (2 tests, 2 assertions). No Pest.
- TypeScript checking via `vue-tsc --noEmit` (`npm run type-check`).

## Test directory

- `tests/Unit/ExampleTest.php`
- `tests/Feature/ExampleTest.php`
- `tests/TestCase.php`

## Test commands

```bash
npm run type-check   # vue-tsc --noEmit
npm run build        # Vite production build
php artisan test     # Laravel test suite
composer validate    # Composer config validity
```

## Environment requirements

- `public/build/manifest.json` must exist (`npm run build`) before `php artisan test` in a fresh checkout (stock feature test renders `/`).

## Unit tests

- `Tests\Unit\ExampleTest` — `that true is true`.

## Feature tests

- `Tests\Feature\ExampleTest` — application returns a successful response (renders `/`).

## Frontend checks

- `npm run type-check` (strict TS).
- `npm run build` (Vite production build, 88 modules).
- Browser verification: routes, navigation, console, responsive, accessibility (documented in module reports).

## Build validation

- `npm run build` exit 0; manifest + hashed assets emitted; no `public/hot`.

## Test limitations

- Only stock example tests exist; no application/business test coverage yet.
- No E2E test framework configured.
- Cross-browser/device lab testing not performed (responsive checks via iframe simulation).