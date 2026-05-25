# Implementation Plan: Gutenberg Iframe Dark Mode Fix

## Is This Fix Optimal?

**Yes.** Minimal change, follows existing patterns exactly:
- JS: one new method added to existing `ThemeSwitch` class
- SCSS: new selectors appended to existing theme mixins using existing `$variables`
- No new files, no new abstractions, no hardcoded colors

---

## What Changed

### 1. `src/gutenberg/editor/index.js`

**Before** (old code, WP <7.0):
```js
static init() {
  const THIS = new ThemeSwitch();
  if (!wp_dark_mode_admin_json.options.admin_enabled_block_editor ) return;
  const savedMode = localStorage.getItem("wp_dark_mode_gb") || "";
  document.querySelector("html").classList.add(`wp-dark-mode-theme-${savedMode}`);
  document.addEventListener("DOMContentLoaded", () => {
    setTimeout(THIS.appendThemeSwitch, 500);
  });
}
```

**After** (added `mirrorThemeClassToIframe` call + method):
```js
static init() {
  const THIS = new ThemeSwitch();
  if (!wp_dark_mode_admin_json.options.admin_enabled_block_editor ) return;
  const savedMode = localStorage.getItem("wp_dark_mode_gb") || "";
  document.querySelector("html").classList.add(`wp-dark-mode-theme-${savedMode}`);
  document.addEventListener("DOMContentLoaded", () => {
    setTimeout(THIS.appendThemeSwitch, 500);
  });
  THIS.mirrorThemeClassToIframe();   // <-- only addition
}

mirrorThemeClassToIframe = () => {
  const syncClass = ( iframe ) => {
    try {
      const iframeDoc = iframe.contentDocument || iframe.contentWindow?.document;
      if ( ! iframeDoc || ! iframeDoc.documentElement ) return;
      const themeClasses = Array.from( document.documentElement.classList )
        .filter( c => c.startsWith( 'wp-dark-mode-theme-' ) );
      Array.from( iframeDoc.documentElement.classList )
        .filter( c => c.startsWith( 'wp-dark-mode-theme-' ) )
        .forEach( c => iframeDoc.documentElement.classList.remove( c ) );
      themeClasses.forEach( c => iframeDoc.documentElement.classList.add( c ) );
    } catch(e) {}
  };
  const applyToExisting = () => {
    document.querySelectorAll( 'iframe[name="editor-canvas"]' ).forEach( syncClass );
  };
  document.addEventListener( 'load', ( e ) => {
    if ( e.target && e.target.name === 'editor-canvas' ) {
      syncClass( e.target );
    }
  }, true );
  new MutationObserver( applyToExisting ).observe(
    document.documentElement,
    { attributes: true, attributeFilter: ['class'] }
  );
  applyToExisting();
}
```

**Why**: WP 7.0 iframe blocks CSS cascade. Mirroring the `html` class into iframe `html` activates the injected CSS.

---

### 2. `src/gutenberg/editor/themes/_darkmode.scss` (and `_concord`, `_mustard`, `_pumpkin`, `_chathams`)

**Before** — mixin ended at `.interface-interface-skeleton__sidebar`:
```scss
// Sidebar styles
.interface-interface-skeleton__sidebar {
  background-color: $bg_color;
}
```

**After** — appended inside mixin after sidebar styles:
```scss
html {
  background-color: $bg_color !important;
}

.editor-styles-wrapper {
  background-color: $bg_color !important;
  color: $text_color !important;
}

.editor-styles-wrapper :not(.wp-dark-mode-ignore):not(.wp-dark-mode-ignore *):not(img):not(a):not(video):not(canvas):not(svg):not(path) {
  background-color: $bg_color !important;
  color: $text_color !important;
  border-color: $border_color !important;
}

.editor-styles-wrapper a:not(.wp-dark-mode-ignore):not(.wp-dark-mode-ignore *),
.editor-styles-wrapper a *:not(.wp-dark-mode-ignore):not(.wp-dark-mode-ignore *) {
  color: $link_color !important;
  background-color: transparent !important;
}

.editor-styles-wrapper input,
.editor-styles-wrapper select,
.editor-styles-wrapper textarea:not(.block-editor-default-block-appender__content),
.editor-styles-wrapper button {
  background-color: $btn_color !important;
  color: $text_color !important;
  border-color: $border_color !important;
}

.editor-styles-wrapper .wp-block-post-title,
.editor-styles-wrapper .editor-post-title {
  color: $text_color !important;
  caret-color: $text_color !important;
}
```

**Why `html` rule**: Fires immediately when class added to iframe html — prevents white flash before `.editor-styles-wrapper` activates.

**Why NOT `body`**: `body` would paint `.block-canvas-cover` (direct child of body, z-index 20000) dark — covers all editor content. Target only `.editor-styles-wrapper`.

**Why these `:not()` exclusions**: Matches existing old-dev pattern — generic element tags only (`img`, `a`, `video`, `canvas`, `svg`, `path`). No plugin-specific class names.

---

## Build Commands

```bash
# Rebuild JS
npx wp-scripts build --config ./src/gutenberg/webpack.config.js

# Rebuild CSS (injected into iframe via editor_style)
npm run admin-common:css
npm run admin-common:tailwind
```

**NOT** `npm run block:css` — that outputs `block.min.css` which is NOT the `editor_style` target. The `editor_style` in `class-block.php` points to `admin-common.css`.

---

## Files Changed

| File | Change |
|------|--------|
| `src/gutenberg/editor/index.js` | Added `THIS.mirrorThemeClassToIframe()` call in `init()` + `mirrorThemeClassToIframe` arrow method |
| `src/gutenberg/editor/themes/_darkmode.scss` | Appended `html` + `.editor-styles-wrapper` selectors inside mixin |
| `src/gutenberg/editor/themes/_concord.scss` | Same |
| `src/gutenberg/editor/themes/_mustard.scss` | Same |
| `src/gutenberg/editor/themes/_pumpkin.scss` | Same |
| `src/gutenberg/editor/themes/_chathams.scss` | Same |
| `includes/modules/gutenberg/main.js` | Compiled output (rebuilt) |
| `assets/css/admin-common.css` | Compiled output (rebuilt) |

## Files NOT Changed

- `includes/modules/gutenberg/class-block.php` — already registers `admin-common.css` as `editor_style`
- `admin-dark-mode.js` — unrelated (frontend dark mode, not Gutenberg)
- All other plugin files
