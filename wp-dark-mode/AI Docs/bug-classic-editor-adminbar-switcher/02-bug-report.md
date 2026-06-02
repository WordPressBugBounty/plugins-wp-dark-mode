# Bug Report: Admin Bar Switcher Broken on Classic Editor Pages

**File changed:** `includes/admin/class-admin-assets.php`
**Lines changed:** ~82–92
**Severity:** High — core feature (admin dark mode toggle) completely non-functional
**Affects:** Classic Editor plugin + TinyMCE Advanced "Replace Block Editor" setting

---

## Root Cause

The click handler for the admin bar Light/Dark switcher lives exclusively in `admin-dark-mode.min.js` (built from `src/admin/dark-mode.js`). This script was not being loaded on `post.php` / `post-new.php` pages when Classic Editor (or TinyMCE Advanced with "Replace Block Editor" enabled) was active.

### Why the Script Was Missing

`class-admin-assets.php` uses a condition to decide whether to enqueue `admin-dark-mode.min.js`. The intent: skip it on Gutenberg post editor pages (Gutenberg has its own integration), but load it everywhere else — including Classic Editor pages.

The condition used `get_option('classic-editor-replace', 'block')` to detect Classic Editor. But:

- Classic Editor's `add_option('classic-editor-replace', 'classic')` only writes to the DB if the key doesn't already exist
- On this site the option was never in the DB — `get_option` returned `false`
- `false` is not `'classic'`, so condition evaluated to `false` on `post-new.php`
- Script never enqueued → click handler never runs → switcher dead

**Debug proof:**
```
WPDM DEBUG: hook=post-new.php editor_type=block raw_opt=false ce_active=YES
```

Same issue exists with **TinyMCE Advanced** when "Replace the Block Editor with the Classic Editor" is checked. It stores its setting in `tadv_admin_settings['options']` as a comma-separated string — completely different option key, never checked by WP Dark Mode.

---

## What Changed

**File:** `includes/admin/class-admin-assets.php`

### Old Code

```php
// Enqueue scripts.
$editor_type = get_option( 'classic-editor-replace', 'block' );
// If the current page is not edit post page.
if ( 'classic' === $editor_type || ! in_array( $hook, [ 'post.php', 'post-new.php' ], true ) ) {
    wp_enqueue_script( 'wp-dark-mode-dark-mode', WP_DARK_MODE_ASSETS . 'js/admin-dark-mode.min.js', [], WP_DARK_MODE_VERSION, false );
}
```

**Problems:**
1. `get_option('classic-editor-replace')` unreliable — may not be in DB
2. No detection of TinyMCE Advanced "Replace Block Editor" setting
3. Short array syntax `[]` fails PHPCS WordPress standard

### New Code

```php
// Enqueue scripts.
// Load admin-dark-mode.min.js everywhere except Gutenberg post editor pages.
// Detect classic editor mode via class existence (Classic Editor plugin) or option (TinyMCE Advanced).
$is_classic_editor_active = class_exists( 'Classic_Editor' );
if ( ! $is_classic_editor_active ) {
    $tadv_admin_settings      = get_option( 'tadv_admin_settings', array() );
    $tadv_admin_options       = ! empty( $tadv_admin_settings['options'] ) ? explode( ',', $tadv_admin_settings['options'] ) : array();
    $is_classic_editor_active = in_array( 'replace_block_editor', $tadv_admin_options, true );
}
$is_gutenberg_post_page = in_array( $hook, array( 'post.php', 'post-new.php' ), true ) && ! $is_classic_editor_active;
if ( ! $is_gutenberg_post_page ) {
    wp_enqueue_script( 'wp-dark-mode-dark-mode', WP_DARK_MODE_ASSETS . 'js/admin-dark-mode.min.js', array(), WP_DARK_MODE_VERSION, false );
}
```

**Fixes:**
1. `class_exists('Classic_Editor')` — reliable, always accurate regardless of DB state
2. Reads `tadv_admin_settings['options']` and checks for `replace_block_editor` value
3. Uses `array()` instead of `[]` — PHPCS compliant

---

## Logic Table

| Scenario | Old | New |
|---|---|---|
| Classic Editor active, on post-new.php | Script NOT loaded (bug) | Script loaded (fixed) |
| TinyMCE Advanced "Replace Block Editor" on, on post-new.php | Script NOT loaded (bug) | Script loaded (fixed) |
| Gutenberg active, on post-new.php | Script not loaded (correct) | Script not loaded (correct) |
| Any other admin page | Script loaded (correct) | Script loaded (correct) |

---

## Verification

Tested via Playwright on `http://wpdarkmode.local/wp-admin/post-new.php?post_type=page`:

- `admin-dark-mode.min.js` confirmed present after fix
- `WPDarkMode.activate` and `DarkModeAuto` available
- Click → `data-wp-dark-mode-active` on `<html>`, switcher active
- Click again → deactivated, back to Light
- Confirmed for both Classic Editor plugin and TinyMCE Advanced "Replace Block Editor"

---

## Key Files

| File | Role |
|---|---|
| `includes/admin/class-admin-assets.php` | PHP enqueue logic — **where the fix lives** |
| `src/admin/dark-mode.js` | Source for `admin-dark-mode.min.js` — contains `listenSwitch()` |
| `assets/js/admin-dark-mode.min.js` | Built output — the script that was missing |
| `includes/admin/class-admin-switches.php` | Renders admin bar switcher HTML |
