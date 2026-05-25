# Bug: Gutenberg Editor Dark Mode Broken (WP 7.0+)

## Problem

WordPress 7.0 moved the block editor canvas into `<iframe name="editor-canvas">`. CSS from the parent page cannot cross the iframe boundary, so dark mode styles never reached the editor canvas — background stayed white.

## Root Cause

Old SCSS targeted only parent-page selectors:
- `.interface-interface-skeleton__header`
- `.interface-interface-skeleton__body`
- `.interface-interface-skeleton__content`
- `.edit-post-visual-editor`

None of these exist inside the iframe. The iframe contains `.editor-styles-wrapper`.

WordPress already injects `admin-common.css` into the iframe via `editor_style` in `class-block.php`. So the CSS is present — but the selectors never matched because `html.wp-dark-mode-theme-*` class only existed on the parent `html`, not the iframe `html`.

## Acceptance Criteria

- Editor canvas renders dark background when dark mode enabled
- All 5 themes (darkmode, concord, mustard, pumpkin, chathams) work
- No white flash on load
- No dark overlay covering editor content
- Fix uses same patterns as existing code — no hardcoding, no over-engineering
- Colors come from SCSS `$variables` only
