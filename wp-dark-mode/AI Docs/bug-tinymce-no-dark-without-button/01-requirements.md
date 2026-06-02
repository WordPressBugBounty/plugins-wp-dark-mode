# Bug: TinyMCE Editor Stays White When Admin Bar Dark Mode is ON (Classic Editor Dark Mode Setting OFF)

## Problem

When "Classic Editor Dark Mode" setting is **disabled** in WP Dark Mode → Admin Panel Dark Mode, the TinyMCE dark mode button is correctly not shown in the editor toolbar. However, the TinyMCE editor content area (iframe body) stays white/light even when the admin bar Light/Dark switcher is toggled to Dark mode.

The rest of the admin UI goes dark correctly. Only the TinyMCE iframe body ignores the admin dark mode state.

## Context

- "Classic Editor Dark Mode" ON → `admin-classic-editor.js` loads → TinyMCE gets a per-editor toggle button → button manages TinyMCE iframe independently via `localStorage`
- "Classic Editor Dark Mode" OFF → no button, no `admin-classic-editor.js` → TinyMCE iframe has no dark mode handler at all → stays white

## Expected Behavior

When "Classic Editor Dark Mode" is OFF:
- No per-editor button in TinyMCE toolbar (correct, intentional)
- TinyMCE editor body background **follows** the admin bar dark mode switcher state
- Toggle Dark → TinyMCE body goes dark
- Toggle Light → TinyMCE body returns to white

When "Classic Editor Dark Mode" is ON:
- Per-editor button exists (existing behavior, unchanged)
- Button manages TinyMCE independently (existing behavior, unchanged)
- Admin bar toggle does NOT interfere with per-editor button state

## Acceptance Criteria

- TinyMCE body syncs to admin bar dark mode when button setting is OFF
- TinyMCE body is NOT double-managed when button setting is ON
- Works on initial page load if dark mode was already active (cookie/localStorage state)
- Works on toggle: Dark → Light → Dark
