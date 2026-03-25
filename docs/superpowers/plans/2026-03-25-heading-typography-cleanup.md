# Heading Typography Cleanup — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Define base h1–h6 styles from Figma design tokens so heading tags carry their own typography, then strip redundant Tailwind classes from all block templates.

**Architecture:** Add complete base rules for `.fb h1` through `.fb h6` in `forest-blocks.css` using existing CSS custom properties. Then audit every block template — align each heading tag to its correct visual tier, and remove classes that the base styles now handle. Only override classes that differ from the base (e.g. `text-[#fff]` for white text on dark backgrounds).

**Tech Stack:** CSS custom properties, Tailwind CSS, PHP render templates

---

## Current State Analysis

### What Figma defines (from variable defs + token export)

The design system has 6 Display heading tiers plus Body styles. Each tier has a designated **font family**, **weight**, **size**, and **line-height** — with responsive mobile/desktop values already wired into CSS variables.

| Tier | Font Family | Weight | CSS Size Var | CSS Leading Var |
|---|---|---|---|---|
| H1 (`display-xxl`) | Aglet Sans (display) | 600 | `--fb-text-display-xxl` | `--fb-leading-display-xxl` |
| H2 (`display-xl`) | Source Serif Pro (heading) | 600 | `--fb-text-display-xl` | `--fb-leading-display-xl` |
| H3 (`display-lg`) | Source Serif Pro (heading) | 600 | `--fb-text-display-lg` | `--fb-leading-display-lg` |
| H4 (`display-md`) | Source Serif Pro (heading) | 600 | `--fb-text-display-md` | `--fb-leading-display-md` |
| H5 (`display-sm`) | Source Sans Pro (body) | 400 | `--fb-text-display-sm` | `--fb-leading-display-sm` |
| H6 (`display-xs`) | Source Sans Pro (body) | 600 | `--fb-text-display-xs` | `--fb-leading-display-xs` |

Figma variable defs confirm:
- `Display/H4/Semibold` → Source Serif Pro, 600, display-md size/leading
- `Display/H5/Regular` → Source Sans Pro, 400, display-sm size/leading
- `Display/H5/Semibold` → Source Sans Pro, 600, display-sm size/leading (variant)

H5 has two variants: Regular (default) and Semibold (opt-in via `font-semibold` class).

### What CSS currently defines

- **h1, h2, h3:** Only margin/padding reset + `text-transform: none`. No font styles at all.
- **h4:** Fully defined (heading font, display-md, 600, forest color). ✅
- **h5:** Fully defined (body font, display-sm, 400, forest color). ✅
- **h6:** Only `font-family: var(--fb-font-body)`. Missing size, weight, line-height, color. ⚠️
- **p:** Fully defined (body font, body-lg, 400). ✅

### Current heading usage across blocks (audit)

**h1** (1 usage):
- `hero-header:44` — `font-display text-display-xxl font-semibold text-forest lg:text-white` → matches H1 tier exactly, override is just `lg:text-white`

**h2** (2 usages):
- `forest-cta:33` — `font-display text-display-xl font-semibold text-forest` → this is display-xl + display font = actually H1's font family at H2's size. **Decision: This is an intentional design choice — forest-cta's main heading uses Aglet Sans at display-xl. Define H2 base as heading font; this block overrides with `font-display`.**
- `cta-form:72` — `font-heading text-display-lg font-semibold text-[#fff]` → display-lg = H3 size but using h2 tag. **Decision: keep as h2 (semantic context — it's the section heading) but it overrides size to display-lg + white text.**

**h3** (1 usage):
- `forest-cta:81` — `font-heading text-display-lg font-semibold text-[#fff]` → matches H3 tier exactly, override is just white text.

**h4** (6 usages):
- `metrics-gallery:43` — `max-w-[768px]` only → relies on base ✅
- `benefits-showcase:38` — no classes → relies on base ✅
- `event-section:48` — `text-[#fff]` only → color override ✅
- `video-block:65` — no classes → relies on base ✅
- `splitter-image:62` — `text-[#fff]` → color override ✅
- `splitter-image:119` — `max-w-[768px]` only → relies on base ✅
- `features-block:45` — `text-[#fff]` → color override ✅

**h5** (9 usages):
- `metrics-gallery:49` — `max-w-[768px]` only → relies on base ✅
- `benefits-showcase:44` — no classes → relies on base ✅
- `benefits-showcase:96` — `font-semibold` → weight override (Semibold variant) ✅
- `event-section:55` — `text-[#fff]` → color override ✅
- `splitter-image:68` — `text-[#fff]` → color override ✅
- `splitter-image:125` — no classes → relies on base ✅
- `step-section:56` — `font-semibold` → weight override ✅
- `features-block:52` — `text-[#fff]` → color override ✅
- `hero-header:83` — `pb-6 font-semibold lg:pb-10` → weight + spacing override ✅
- `testimonial-stack:79` — `font-semibold` → weight override ✅
- `testimonial-stack:86` — no classes → relies on base ✅

**h6** (6 usages):
- `metrics-gallery:177` — `relative text-display-xs font-semibold text-forest` → needs size, weight, color (all would be base) ⚠️
- `event-section:186` — `text-display-xs font-semibold text-[#fff]` → size + weight would be base, just needs white override ⚠️
- `step-section:131` — `step-section__card-text text-display-xs font-semibold text-forest` → size + weight would be base ⚠️
- `features-block:108` — `text-display-xs` → size would be base, missing weight ⚠️
- `hero-header:65` — `text-display-xs font-semibold text-forest lg:text-white` → size + weight would be base ⚠️
- `testimonial-stack:147` — `text-display-xs font-semibold text-[#fff]` → size + weight would be base ⚠️

**Summary:** h4 and h5 are well-defined and blocks already rely on them cleanly. h6 is the biggest mess — every single usage manually specifies `text-display-xs font-semibold` because the base style is incomplete. h1-h3 are rare and fully specified inline.

---

## Task 1: Define complete h1–h3 and fix h6 base styles

**Files:**
- Modify: `assets/css/forest-blocks.css:153-180`

- [ ] **Step 1: Add h1 base style**

Add after the `text-transform: none` rule block (line 160), before the existing h4 rule:

```css
.fb h1 {
	font-family: var(--fb-font-display);
	font-size: var(--fb-text-display-xxl);
	font-weight: 600;
	line-height: var(--fb-leading-display-xxl);
	color: var(--fb-color-text-primary);
}
```

- [ ] **Step 2: Add h2 base style**

```css
.fb h2 {
	font-family: var(--fb-font-heading);
	font-size: var(--fb-text-display-xl);
	font-weight: 600;
	line-height: var(--fb-leading-display-xl);
	color: var(--fb-color-text-primary);
}
```

- [ ] **Step 3: Add h3 base style**

```css
.fb h3 {
	font-family: var(--fb-font-heading);
	font-size: var(--fb-text-display-lg);
	font-weight: 600;
	line-height: var(--fb-leading-display-lg);
	color: var(--fb-color-text-primary);
}
```

- [ ] **Step 4: Complete h6 base style**

Replace the existing `.fb h6` rule (currently only `font-family`) with:

```css
.fb h6 {
	font-family: var(--fb-font-body);
	font-size: var(--fb-text-display-xs);
	font-weight: 600;
	line-height: var(--fb-leading-display-xs);
	color: var(--fb-color-text-primary);
}
```

- [ ] **Step 5: Build and verify**

Run: `npm run build`
Expected: Successful build, no errors.

- [ ] **Step 6: Commit**

```bash
git add assets/css/forest-blocks.css
git commit -m "feat: define complete h1-h6 base typography from Figma tokens"
```

---

## Task 2: Strip redundant classes from h1 tag (hero-header)

**Files:**
- Modify: `blocks/hero-header/render.php:44`

- [ ] **Step 1: Clean up h1**

Current:
```php
<h1 class="font-display text-display-xxl font-semibold text-forest lg:max-w-[722px] lg:text-white">
```

The base h1 now provides `font-display`, `text-display-xxl`, `font-semibold` (600), and `text-forest`. Remove those, keep only overrides:

```php
<h1 class="lg:max-w-[722px] lg:text-white">
```

- [ ] **Step 2: Build and verify**

Run: `npm run build`

- [ ] **Step 3: Commit**

```bash
git add blocks/hero-header/render.php
git commit -m "refactor: strip redundant heading classes from hero-header"
```

---

## Task 3: Strip redundant classes from h2 tags (forest-cta, cta-form)

**Files:**
- Modify: `blocks/forest-cta/render.php:33`
- Modify: `blocks/cta-form/render.php:72`

- [ ] **Step 1: Clean up forest-cta h2**

Current:
```php
<h2 class="font-display text-display-xl font-semibold text-forest">
```

Base h2 provides `font-heading`, `text-display-xl`, `font-semibold`, `text-forest`. This block intentionally uses `font-display` (Aglet Sans) instead of the base `font-heading` — so that override stays:

```php
<h2 class="font-display">
```

- [ ] **Step 2: Clean up cta-form h2**

Current:
```php
<h2 class="max-w-[768px] font-heading text-display-lg font-semibold text-[#fff]">
```

Base h2 provides `font-heading` and `font-semibold`. This block overrides size to `display-lg` and color to white:

```php
<h2 class="max-w-[768px] text-display-lg text-[#fff]">
```

- [ ] **Step 3: Build and verify**

Run: `npm run build`

- [ ] **Step 4: Commit**

```bash
git add blocks/forest-cta/render.php blocks/cta-form/render.php
git commit -m "refactor: strip redundant heading classes from h2 tags"
```

---

## Task 4: Strip redundant classes from h3 tag (forest-cta)

**Files:**
- Modify: `blocks/forest-cta/render.php:81`

- [ ] **Step 1: Clean up forest-cta h3**

Current:
```php
<h3 class="font-heading text-display-lg font-semibold text-[#fff]">
```

Base h3 provides `font-heading`, `text-display-lg`, `font-semibold`, `text-forest`. Only override is white text:

```php
<h3 class="text-[#fff]">
```

- [ ] **Step 2: Build and verify**

Run: `npm run build`

- [ ] **Step 3: Commit**

```bash
git add blocks/forest-cta/render.php
git commit -m "refactor: strip redundant heading classes from h3 tag"
```

---

## Task 5: Strip redundant classes from h6 tags (all blocks)

**Files:**
- Modify: `blocks/metrics-gallery/render.php:177`
- Modify: `blocks/event-section/render.php:186`
- Modify: `blocks/step-section/render.php:131`
- Modify: `blocks/features-block/render.php:108`
- Modify: `blocks/hero-header/render.php:65`
- Modify: `blocks/testimonial-stack/render.php:147`

- [ ] **Step 1: Clean up metrics-gallery h6**

Current:
```php
<h6 class="relative text-display-xs font-semibold text-forest">
```

Base h6 now provides `text-display-xs`, `font-semibold` (600), and `text-forest`. Keep only `relative` (layout):

```php
<h6 class="relative">
```

- [ ] **Step 2: Clean up event-section h6**

Current:
```php
<h6 class="text-display-xs font-semibold text-[#fff]">
```

Base provides size + weight. Only override is white:

```php
<h6 class="text-[#fff]">
```

- [ ] **Step 3: Clean up step-section h6**

Current:
```php
<h6 class="step-section__card-text text-display-xs font-semibold text-forest <?php echo 0 !== $i ? 'opacity-25' : ''; ?>">
```

Base provides size, weight, color. Keep JS hook class + dynamic opacity:

```php
<h6 class="step-section__card-text <?php echo 0 !== $i ? 'opacity-25' : ''; ?>">
```

- [ ] **Step 4: Clean up features-block h6**

Current:
```php
<h6 class="text-display-xs">
```

Base provides size + weight. No overrides needed:

```php
<h6>
```

- [ ] **Step 5: Clean up hero-header h6**

Current:
```php
<h6 class="text-display-xs font-semibold text-forest lg:text-white">
```

Base provides size, weight, color. Only override is responsive white:

```php
<h6 class="lg:text-white">
```

- [ ] **Step 6: Clean up testimonial-stack h6**

Current:
```php
<h6 class="text-display-xs font-semibold text-[#fff]">
```

Base provides size + weight. Only override is white:

```php
<h6 class="text-[#fff]">
```

- [ ] **Step 7: Build and verify**

Run: `npm run build`
Expected: CSS output may shrink slightly as purged classes drop out.

- [ ] **Step 8: Commit**

```bash
git add blocks/metrics-gallery/render.php blocks/event-section/render.php blocks/step-section/render.php blocks/features-block/render.php blocks/hero-header/render.php blocks/testimonial-stack/render.php
git commit -m "refactor: strip redundant heading classes from all h6 tags"
```

---

## Task 6: Final validation build

- [ ] **Step 1: Full build**

Run: `npm run build`
Expected: Successful build.

- [ ] **Step 2: Verify no remaining redundant heading classes**

Run a grep to confirm no h-tags still carry classes that match their base style:

```bash
# h1 tags should NOT have: font-display text-display-xxl font-semibold text-forest (unless overriding)
# h4 tags should NOT have: font-heading text-display-md font-semibold text-forest
# h6 tags should NOT have: text-display-xs font-semibold text-forest
grep -rn '<h[1-6]' blocks/*/render.php
```

Manually review that every remaining class on a heading tag is a genuine override (color, layout, spacing, responsive variant) — not a restatement of the base.

- [ ] **Step 3: Commit any final tweaks if needed**

---

## Summary of changes

| What | Before | After |
|---|---|---|
| `.fb h1` | No styles | display font, display-xxl, 600, forest |
| `.fb h2` | No styles | heading font, display-xl, 600, forest |
| `.fb h3` | No styles | heading font, display-lg, 600, forest |
| `.fb h4` | Already complete | No change |
| `.fb h5` | Already complete | No change |
| `.fb h6` | Only font-family | + display-xs, 600, leading, forest |
| Block templates | ~40 redundant classes across 10 blocks | Only override classes remain |

## Not in scope (conscious decisions)

- **Token JSON sync for non-text collections** (Color, Spacing, Corner Radius) — the CSS vars already match; a full sync is a separate effort.
- **Changing h-tag levels for semantic correctness** — the current tag choices reflect the page hierarchy as intended. If a block uses `h2` with `text-display-lg`, that's a conscious size override, not a wrong tag.
- **Responsive CSS variable values** — already handled by the existing `@media (min-width: 1024px)` block in the CSS. No changes needed.
