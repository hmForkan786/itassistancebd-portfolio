# Troubleshooting — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Common issues

- **`php artisan test` fails with missing manifest:** Run `npm run build` first (`public/build/manifest.json` required by stock feature test).
- **Stale `public/hot`:** If a killed dev server leaves `public/hot`, delete it before production-style testing.
- **`PHP_CLI_SERVER_WORKERS` notice:** `artisan serve` warns without `--no-reload`; single worker locally (non-blocking).
- **npm esbuild allow-scripts warning:** Harmless; esbuild binary resolves from `@esbuild/win32-x64`.
- **Dev routes not rendering in production build:** Expected — `/dev/ui` and `/dev/layout` are guarded by `import.meta.env.DEV`.
- **Hash navigation not scrolling on direct load:** Native browser fragment scrolling provides fallback; Vue Router scrollBehavior checks target existence first.
- **Lighthouse `landmark-one-main` transient failure:** SPA hydration timing artifact; re-run after full render.

## Notes

- No production hosting/deployment has been executed. Hosting-specific issues must be diagnosed on the actual host.
- See `docs/ENVIRONMENT_SETUP.md` for environment health checks.