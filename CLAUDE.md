# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Build Commands

- `npm run build` — Production build (Vite → `dist/`)
- `npm run dev` — Watch mode for development (Vite build with `--watch`)

No test runner or linter is configured.

## Architecture

This is a WordPress plugin ("Forest Blocks") that provides ACF (Advanced Custom Fields) blocks styled with Tailwind CSS. The front-end asset pipeline uses Vite.

### Vite Build Pipeline

Three entry points defined in `vite.config.js`:
- `assets/css/forest-blocks.css` → `dist/forest-blocks.css` (Tailwind-compiled front-end + editor styles)
- `src/css/editor.css` → `dist/editor.css` (editor-only styles)
- `src/js/main.js` → `dist/main.js` (front-end JavaScript)

The main plugin file (`forest-blocks.php`) enqueues `dist/forest-blocks.css` and `dist/main.js` on the front end, and both CSS files in the block editor.

### Tailwind CSS Scoping

Tailwind is configured with `important: '.fb'` and `preflight: false` in `tailwind.config.js`. This means:
- All Tailwind utility classes only apply inside elements with the `.fb` class
- Every block render template must wrap its output in a root `<div class="fb">` for Tailwind utilities to take effect
- Preflight (base reset) is disabled to avoid conflicts with WordPress/theme styles

**CRITICAL — `open_tag()` and Tailwind utilities:**
Because `important: '.fb'` generates descendant selectors (e.g. `.fb .bg-white`), Tailwind utilities placed **on the root `.fb` element itself** will NOT work — the selector requires `.bg-white` to be a *child* of `.fb`, not the same element. Only pass semantic/identifier class names to `$b->open_tag()` (e.g. `'hero-header'`, `'video-block'`). For any Tailwind styling on the block root, add an inner wrapper `<div>`:
```php
<?php $b->open_tag( 'my-block' ); ?>
<div class="bg-white py-10 relative">
  <!-- block content -->
</div>
<?php $b->close_tag(); ?>
```

Tailwind scans `blocks/**/*.php`, `includes/**/*.php`, and `src/**/*.js` for class usage.

### Reusable SVG Icons (`assets/images/`)

Decorative SVG icons live in `assets/images/` and use `currentColor` for stroke color so they inherit from the parent's `color`/`text-*` class. Include them inline in templates via PHP:

```php
<div class="text-forest">
  <?php include FOREST_BLOCKS_PATH . 'assets/images/tree-round.svg'; ?>
</div>
```

Key files: `tree-round.svg`, `tree-pine.svg`, `tree-simple.svg`, `tree-large.svg`, `tree-small.svg`, `forest-silhouette.svg`, `icon-calendar.svg`, `geo-wave-*.svg`.

### Block Registration

Blocks are auto-discovered by `includes/register-blocks.php` on the `acf/init` hook. It globs `blocks/*/block.json`, reads the metadata, and registers each via `acf_register_block_type()` with absolute render template paths (required for plugin context — ACF's `locate_template()` only checks the theme directory).

### Design Tokens (from Figma Variables)

CSS custom properties are defined on `.fb` in `assets/css/forest-blocks.css`, sourced from the Figma variable collections (`Color.json`, `Text.json`, `Spacing.json` in `tmp/`). Use Tailwind utility classes in templates — they all reference these CSS variables.

**Colors** — Figma naming convention (Brand/Element):

| Tailwind class prefix | CSS variable | Hex | Usage |
|---|---|---|---|
| `forest` | `--fb-color-forest` | `#003b45` | Primary brand / text |
| `forest-80` | `--fb-color-forest-80` | `#0c606d` | Borders, subtle accents |
| `forest-60` | `--fb-color-forest-60` | `#00bbc9` | Lighter accent |
| `forest-5` | `--fb-color-forest-5` | `#e9fffc` | Very light tint |
| `fire` | `--fb-color-fire` | `#e95429` | CTA buttons, dividers |
| `fire-80/60/40/20` | `--fb-color-fire-*` | see CSS | Fire tint scale |
| `water` | `--fb-color-water` | `#00667d` | Secondary brand |
| `water-60` | `--fb-color-water-60` | `#0099b5` | Lighter water accent |
| `air` | `--fb-color-air` | `#f5e9e0` | Light background |
| `earth` / `earth-40` | `--fb-color-earth(-40)` | `#a5714e` / `#c5a17f` | Warm accents |
| `tree` / `tree-40` | `--fb-color-tree(-40)` | `#677d48` / `#94a972` | Green accent |
| `grey-5` through `grey-90` | `--fb-color-grey-*` | see CSS | Neutral scale |

Usage: `text-forest`, `bg-fire`, `border-forest-80`, `bg-grey-5`, etc.

**Font families:** `font-display` (Aglet Sans), `font-heading` (Source Serif Pro), `font-body` (Source Sans Pro)

**Typography — responsive via CSS variables (mobile-first, desktop at `lg`):**

Just use `text-display-xxl` etc. — the size and line-height automatically adjust at the `lg` (1024px) breakpoint. No `lg:text-*` overrides needed for font sizes.

| Token | Mobile | Desktop | Usage |
|---|---|---|---|
| `text-display-xxl` | 64px / 80px | 124px / 116px | Hero headings |
| `text-display-xl` | 56px / 72px | 80px / 90px | Large section headings |
| `text-display-lg` | 40px / 56px | 56px / 64px | Section headings |
| `text-display-md` | 32px / 40px | 40px / 56px | Subsection headings |
| `text-display-sm` | 24px / 32px | 32px / 40px | Small headings |
| `text-display-xs` | 20px / 28px | 24px / 32px | Tiny headings |
| `text-body-lg` | 18px / 28px | 18px / 30px | Large body |
| `text-body-md` | 16px / 24px | 16px / 26px | Default body |
| `text-body-sm` | 12px / 18px | 12px / 20px | Small body |
| `text-body-xs` | 8px / 14px | 8px / 16px | Extra small |
| `text-eyebrow-lg/md/sm` | 20/16/12px | same | Eyebrow labels |
| `text-button-md/sm` | 18/16px | same | Button text |

**Other utilities:**

| Tailwind class | Value |
|---|---|
| `rounded-container-md` | 16px |
| `rounded-container-lg` | 32px |
| `rounded-container-xl` | 80px |
| `rounded-curve` | 64px |
| `shadow-card` | `0px 2px 40px 0px rgba(0,0,0,0.24)` |
| `shadow-card-elevated` | `0px 2px 40px 24px rgba(0,0,0,0.24)` |
| `max-w-container` | 1260px |
| `max-w-content` | 1024px |

**Container pattern:** All block content sections use `mx-auto w-[94%] max-w-container` — no horizontal padding (`px-*`). The `w-[94%]` provides consistent 3% gutters on each side at all breakpoints, capped at 1260px. Example:
```html
<div class="mx-auto w-[94%] max-w-container">
  <!-- block content -->
</div>
```

**Spacing:** Uses Tailwind's default 4px-based scale which matches the Figma spacing collection exactly (e.g. `gap-6` = 24px, `p-10` = 40px, `p-20` = 80px). No custom spacing tokens needed.

### FB_Block Helper (`includes/class-fb-block.php`)

A lightweight instantiated helper that reduces boilerplate in render templates. Usage is opt-in — procedural templates continue to work without it.

**Instantiation (one line at the top of any render.php):**
```php
$b = new FB_Block( $block, $is_preview, $post_id );
```

**Key methods:**
| Method | Returns | Purpose |
|---|---|---|
| `classes( $extra )` | `string[]` | `['fb', className, align...]` array |
| `class_attr( $extra )` | `string` | Escaped class string for HTML attribute |
| `anchor()` | `string` | Escaped anchor/id or empty string |
| `open_tag( $extra )` | void (prints) | `<div class="..." id="...">` |
| `close_tag()` | void (prints) | `</div>` |
| `field( $name, $default )` | `mixed` | `get_field()` with fallback |
| `text( $name, $default )` | void (echoes) | `esc_html( field(...) )` |
| `image( $name, $size, $class )` | `string` | `wp_get_attachment_image()` from ACF image array |
| `is_preview()` | `bool` | Whether in editor preview |
| `post_id()` | `int` | Current post ID |
| `name()` | `string` | Block name (e.g. `acf/example`) |

### Reusable UI Components (`includes/components.php`)

Standalone PHP functions that return HTML for repeated UI elements. Auto-loaded via `register-blocks.php`. Use these instead of duplicating Tailwind class strings across block templates.

| Function | Purpose | Example |
|---|---|---|
| `fb_button( $link, $label, $extra )` | Solid fire CTA pill button with chevron | `<?php echo fb_button( $cta ); ?>` |
| `fb_text_link( $link, $label, $color, $extra )` | Text link with chevron arrow (no bg) | `<?php echo fb_text_link( $link ); ?>` |
| `fb_inline_link( $link, $label, $extra )` | Fire-colored inline text link with chevron | `<?php echo fb_inline_link( $feat_link ); ?>` |
| `fb_eyebrow( $text, $size, $bg, $extra )` | Rounded pill badge | `<?php echo fb_eyebrow( $eyebrow ); ?>` |

All accept an ACF link array (with `url`, `title`, `target` keys) and return empty string when the URL is missing. The `$extra` parameter appends additional Tailwind classes (e.g. `'mt-6'`, `'w-fit'`).

### Programmatic Field Definitions (`fields.php`)

Each block can optionally include a `fields.php` file that registers its ACF field group programmatically via `acf_add_local_field_group()`. These files are auto-loaded by `includes/register-fields.php` on the `acf/include_fields` hook.

**Key naming convention:**
- Group key: `group_fb_<block>` (e.g. `group_fb_example`)
- Field key: `field_fb_<block>_<field>` (e.g. `field_fb_example_heading`)

This is optional — blocks can still use GUI-defined field groups synced to `acf-json/`. When both exist, PHP definitions take priority.

### Block Render Template Conventions

Use `FB_Block` for new blocks (see `blocks/example/render.php`):
- `$b = new FB_Block( $block, $is_preview, $post_id );` at the top
- `$b->field()` for field values with defaults
- `$b->open_tag()` / `$b->close_tag()` for the root `<div>` (includes `fb` class and anchor)
- Use component functions (`fb_button()`, `fb_text_link()`, `fb_eyebrow()`, etc.) for repeated UI elements
- Escape all output with `esc_html()` / `esc_attr()`

Procedural templates (without `FB_Block`) are still supported — the class is opt-in.

### Adding a New Block

1. Create a folder under `blocks/<block-name>/` with:
   - `block.json` — Block metadata with `"name": "acf/<block-name>"`, `"category": "forest-blocks"`, and an `"acf"` key pointing `renderTemplate` to the render file
   - `render.php` — PHP render template using `FB_Block`
   - `fields.php` — (optional) Programmatic ACF field group definition
2. The block is auto-registered; no manual registration needed
3. Fields can be defined in `fields.php` (recommended) or via the GUI with `acf-json/` sync
