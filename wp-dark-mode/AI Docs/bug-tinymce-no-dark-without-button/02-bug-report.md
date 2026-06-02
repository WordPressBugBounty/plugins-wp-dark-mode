# Bug Report: TinyMCE Body Doesn't Follow Admin Bar Dark Mode (Button Setting OFF)

**Files changed:**
- `src/admin/dark-mode.js` — source (appended TinyMCE sync block)
- `assets/js/admin-dark-mode.min.js` — built output (appended same logic, minified)

**Severity:** Medium — visual inconsistency; editor content area stays white while all other admin UI is dark

---

## Root Cause

TinyMCE runs inside an `<iframe>` with its own `document`. The main page's `DarkModeAuto.enable()` (Dark Reader library) only targets the parent document — it cannot cross iframe boundaries. So the TinyMCE content area requires explicit style injection into `editor.getDoc()`.

Two separate systems handle TinyMCE dark mode:

| System | File | When active |
|---|---|---|
| Per-editor button | `assets/js/admin-classic-editor.js` | "Classic Editor Dark Mode" setting ON |
| Admin bar sync | `assets/js/admin-dark-mode.min.js` (new) | Always, but skips if button plugin loaded |

When "Classic Editor Dark Mode" is OFF, `admin-classic-editor.js` never loads. Nothing syncs the TinyMCE iframe to the admin bar state. White background persists in dark mode.

---

## What Changed

### Files Modified

| File | Change type |
|---|---|
| `src/admin/dark-mode.js` | Appended — TinyMCE sync IIFE added after `new DarkMode()` |
| `assets/js/admin-dark-mode.min.js` | Appended — minified version of same logic |

---

## Old Behavior

`assets/js/admin-dark-mode.min.js` ended at:

```javascript
// ... DarkMode class definition ...
new wt  // instantiates DarkMode
})();
// END OF FILE — no TinyMCE handling
```

TinyMCE iframe body had no dark mode styling when button setting was OFF.

---

## New Behavior

After `new DarkMode()`, an additional IIFE runs:

```javascript
(function () {
    const STYLE_ID = 'wp-dark-mode-admin-bar-sync-style';

    const THEME_COLORS = {
        darkmode: { bg: '#1B2836', text: '#fff',    link: '#459BE6' },
        chathams: { bg: '#171717', text: '#bfb7c0', link: '#f776f0' },
        pumpkin:  { bg: '#1e1d19', text: '#d6cb99', link: '#ff9323' },
        mustard:  { bg: '#151819', text: '#d5d6d7', link: '#daa40b' },
        concord:  { bg: '#171717', text: '#bfb7c0', link: '#f776f0' },
        default:  { bg: 'rgb(32, 35, 36)', text: '#f0f0f0', link: 'skyblue' },
    };

    function getThemeColors() {
        const active = Array.from( document.documentElement.classList )
            .find( c => c.startsWith( 'wp-dark-mode-theme-' ) );
        const key = active ? active.replace( 'wp-dark-mode-theme-', '' ) : 'default';
        return THEME_COLORS[ key ] || THEME_COLORS.default;
    }

    // Inject/remove dark styles into every TinyMCE iframe that is NOT managed
    // by admin-classic-editor.js (i.e. the per-editor button plugin is absent).
    function applyToMCEEditors( dark ) {
        if ( typeof tinymce === 'undefined' ) {
            return;
        }
        tinymce.editors.forEach( function ( editor ) {
            // Skip editors already managed by the per-editor button plugin.
            if ( editor.plugins && editor.plugins.dark_mode_button ) {
                return;
            }
            const doc = editor.getDoc();
            if ( ! doc ) {
                return;
            }
            let style = doc.getElementById( STYLE_ID );
            if ( dark ) {
                const c = getThemeColors();
                if ( ! style ) {
                    style = doc.createElement( 'style' );
                    style.id = STYLE_ID;
                    doc.head.appendChild( style );
                }
                style.textContent = `body { background-color: ${c.bg} !important; color: ${c.text} !important; } a { color: ${c.link}; }`;
            } else {
                if ( style ) {
                    style.remove();
                }
            }
        } );
    }

    // Sync on every admin bar toggle.
    document.addEventListener( 'wp_dark_mode', function ( e ) {
        applyToMCEEditors( e.detail && e.detail.isActive );
    } );

    // Sync on editor init — handles case where dark mode is already ON when page loads.
    // tinymce-editor-init is a jQuery event fired by wp-admin/js/editor.
    if ( typeof jQuery !== 'undefined' ) {
        jQuery( document ).on( 'tinymce-editor-init', function ( event, editor ) {
            if ( ! editor ) {
                return;
            }
            if ( editor.plugins && editor.plugins.dark_mode_button ) {
                return;
            }
            if ( WPDarkMode && WPDarkMode.isActive ) {
                const doc = editor.getDoc();
                if ( ! doc ) {
                    return;
                }
                const c = getThemeColors();
                let style = doc.getElementById( STYLE_ID );
                if ( ! style ) {
                    style = doc.createElement( 'style' );
                    style.id = STYLE_ID;
                    doc.head.appendChild( style );
                }
                style.textContent = `body { background-color: ${c.bg} !important; color: ${c.text} !important; } a { color: ${c.link}; }`;
            }
        } );
    }
}());
```

---

## Key Design Decisions

**Why append to `admin-dark-mode.min.js` not `admin-classic-editor.js`?**
`admin-classic-editor.js` only loads when "Classic Editor Dark Mode" is ON. The fix needs to run when that setting is OFF.

**Why skip editors with `dark_mode_button` plugin?**
When the per-editor button IS loaded, `admin-classic-editor.js` manages that editor's TinyMCE state via its own `localStorage`-backed toggle. Letting two systems both inject styles into the same iframe would cause conflicts and incorrect state.

**Why `tinymce-editor-init` (jQuery) not `DOMContentLoaded`?**
`tinymce-editor-init` fires after each TinyMCE instance fully initialises — `editor.getDoc()` is available and the iframe body exists. WordPress core fires this event from `wp-admin/js/editor` via `$(document).trigger('tinymce-editor-init', [editor])`.

**Why `STYLE_ID = 'wp-dark-mode-admin-bar-sync-style'`?**
Unique ID prevents duplicate `<style>` elements on repeated toggles and avoids collision with `admin-classic-editor.js` which uses `wp-dark-mode-classic-editor-style`.

---

## Verification

Tested via Playwright on `http://wpdarkmode.local/wp-admin/post-new.php?post_type=page` with Classic Editor active and "Classic Editor Dark Mode" setting OFF:

| Check | Result |
|---|---|
| Dark mode OFF → TinyMCE body bg | `rgb(255, 255, 255)` ✓ |
| Sync style tag absent when dark OFF | ✓ |
| Dark mode ON → TinyMCE body bg | `rgb(32, 35, 36)` ✓ |
| Sync style tag present when dark ON | ✓ |
| Style content | `body{background-color:rgb(32, 35, 36)!important;color:#f0f0f0!important;}a{color:skyblue}` ✓ |
| Admin UI also dark | ✓ (screenshot confirmed) |

---

## Key Files

| File | Role |
|---|---|
| `assets/js/admin-dark-mode.min.js` | **Modified** — TinyMCE sync logic appended |
| `src/admin/dark-mode.js` | **Modified** — source truth for the above |
| `assets/js/admin-classic-editor.js` | Unchanged — manages TinyMCE when button setting is ON |
| `includes/admin/class-admin-assets.php` | Unchanged — already fixed in previous bug |
