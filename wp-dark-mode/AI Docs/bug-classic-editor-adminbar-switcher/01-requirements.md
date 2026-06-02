# Bug: Admin Bar Light/Dark Switcher Broken with Classic Editor

## Problem

When Classic Editor plugin is active, the Light/Dark switcher in the WordPress admin bar is completely unresponsive. Clicking it does nothing — no toggle, no visual feedback, no mode change.

Works correctly on all other admin pages (Dashboard, Settings, Plugins, etc). Broken only on post/page editor screens (`post.php`, `post-new.php`) when Classic Editor is active.

## Steps to Reproduce

1. Activate Classic Editor plugin
2. Navigate to any post or page editor (`/wp-admin/post-new.php?post_type=page`)
3. Click the Light/Dark switcher in the admin top bar
4. Nothing happens

## Expected Behavior

Switcher toggles between Light and Dark mode regardless of which editor is active.

## Acceptance Criteria

- Switcher works on Classic Editor post/page screens
- Switcher continues to work on all other admin pages
- Gutenberg post editor pages still skip `admin-dark-mode.min.js` (intentional — Gutenberg has its own integration)
- No regressions on non-editor admin screens
