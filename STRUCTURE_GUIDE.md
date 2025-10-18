# 📁 TMS Landing Page - Modular Structure Guide

## 🎯 Filosofi Struktur

Struktur ini dirancang dengan prinsip:
1. **Hero Section INLINE** - Langsung di `landing_page.blade.php` (tidak ada file terpisah)
2. **Section Modular** - Setiap section punya 1 CSS + 1 JS
3. **Partial Modular** - Setiap partial punya 1 CSS + 1 JS
4. **Clean Organization** - CSS & JS dipisah per komponen untuk maintainability

---

## 📂 File Structure

```
resources/views/
├── landing_page.blade.php          # ✅ Main file + Hero Section (inline)
├── partials/
│   ├── header.blade.php            # 🔹 Header navigation
│   ├── footer.blade.php            # 🔹 Footer content
│   └── client-modal.blade.php      # 🔹 Client detail modal
└── sections/
    ├── fitur.blade.php             # 🔸 Features section
    ├── client.blade.php            # 🔸 Client showcase (Swiper slider)
    ├── faq.blade.php               # 🔸 FAQ accordion
    └── testimonials.blade.php      # 🔸 Testimonials section

public/css/
├── landing.css                     # ⚙️ Global base styles
├── swiper.css                      # ⚙️ Swiper library styles
├── partials/
│   ├── header.css                  # 🎨 Header-specific styles
│   ├── footer.css                  # 🎨 Footer-specific styles
│   └── client-modal.css            # 🎨 Modal-specific styles
└── sections/
    ├── fitur.css                   # 🎨 Features-specific styles
    ├── client.css                  # 🎨 Client slider-specific styles
    ├── faq.css                     # 🎨 FAQ-specific styles
    └── testimonials.css            # 🎨 Testimonials-specific styles

public/js/
├── landing.js                      # ⚙️ Global JavaScript functions
├── partials/
│   ├── header.js                   # ⚡ Header navigation logic
│   ├── footer.js                   # ⚡ Footer interactions
│   └── client-modal.js             # ⚡ Modal open/close logic
└── sections/
    ├── fitur.js                    # ⚡ Features animations
    ├── client.js                   # ⚡ Swiper initialization + counters
    ├── faq.js                      # ⚡ FAQ accordion logic
    └── testimonials.js             # ⚡ Testimonials animations
```

---

## 🧩 Component Breakdown

### 🏠 Main File
- **landing_page.blade.php**
  - Imports semua CSS di `<head>`
  - Includes semua partials/sections di `<body>`
  - Imports semua JS di bagian bawah
  - **Hero section langsung inline** di file ini (tidak ada file terpisah)

### 🔹 Partials (Komponen Reusable)
1. **Header** (`header.blade.php` + `header.css` + `header.js`)
   - Sticky navigation
   - Smooth scroll
   - Active link highlighting
   - Mobile menu toggle

2. **Footer** (`footer.blade.php` + `footer.css` + `footer.js`)
   - Company info & links
   - Social media icons
   - Newsletter form
   - Scroll-to-top button

3. **Client Modal** (`client-modal.blade.php` + `client-modal.css` + `client-modal.js`)
   - Popup detail produk
   - Smooth open/close animations
   - Backdrop blur effect

### 🔸 Sections (Content Blocks)
1. **Fitur** (`fitur.blade.php` + `fitur.css` + `fitur.js`)
   - Feature cards dengan icon
   - Scroll animations
   - Hover effects

2. **Client** (`client.blade.php` + `client.css` + `client.js`)
   - Swiper slider dengan 5 cards
   - Centered layout dengan opacity effects
   - Auto-play continuous loop
   - Counter animations
   - "Lihat Detail" buttons

3. **FAQ** (`faq.blade.php` + `faq.css` + `faq.js`)
   - Accordion system
   - Expand/collapse animations
   - Single active item

4. **Testimonials** (`testimonials.blade.php` + `testimonials.css` + `testimonials.js`)
   - Testimonial cards
   - Star ratings
   - Scroll animations

---

## 📋 Import Order (Landing Page)

### CSS Order (di `<head>`):
```html
<!-- 1. External Libraries -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.../font-awesome/...">
<link rel="stylesheet" href="https://cdn.../swiper-bundle.min.css">

<!-- 2. Base Styles -->
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('css/swiper.css') }}">

<!-- 3. Partials CSS -->
<link rel="stylesheet" href="{{ asset('css/partials/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/partials/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/partials/client-modal.css') }}">

<!-- 4. Sections CSS -->
<link rel="stylesheet" href="{{ asset('css/sections/fitur.css') }}">
<link rel="stylesheet" href="{{ asset('css/sections/client.css') }}">
<link rel="stylesheet" href="{{ asset('css/sections/faq.css') }}">
<link rel="stylesheet" href="{{ asset('css/sections/testimonials.css') }}">
```

### JS Order (sebelum `</body>`):
```html
<!-- 1. Base JavaScript -->
<script src="{{ asset('js/landing.js') }}"></script>

<!-- 2. Partials JS -->
<script src="{{ asset('js/partials/header.js') }}"></script>
<script src="{{ asset('js/partials/footer.js') }}"></script>
<script src="{{ asset('js/partials/client-modal.js') }}"></script>

<!-- 3. Sections JS -->
<script src="{{ asset('js/sections/fitur.js') }}"></script>
<script src="{{ asset('js/sections/client.js') }}"></script>
<script src="{{ asset('js/sections/faq.js') }}"></script>
<script src="{{ asset('js/sections/testimonials.js') }}"></script>
```

---

## 🎨 Styling Convention

### Tailwind CSS (Primary)
- **Inline di Blade files** untuk utility classes
- Responsive breakpoints: `sm:`, `md:`, `lg:`, `xl:`, `2xl:`
- Custom colors: `#FD0103` (TMS Red)

### Custom CSS (Secondary)
- **Untuk complex animations & transitions**
- **Untuk Swiper overrides**
- Naming: `.section-name-element` (e.g., `.client-card`, `.faq-item`)

### CSS Structure:
```css
/* ============================================
   SECTION NAME - Description
   ============================================ */

/* Element Styles */
.element-class {
    /* Properties */
}

/* Hover/Active States */
.element-class:hover {
    /* Hover effects */
}

/* Animations */
@keyframes animationName {
    /* Keyframes */
}
```

---

## ⚡ JavaScript Convention

### Module Pattern:
```javascript
const initSectionName = () => {
    console.log('🚀 Initializing Section...');
    
    // Your logic here
    
    console.log('✅ Section initialized');
};

// Auto-initialize
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSectionName);
} else {
    initSectionName();
}
```

### Best Practices:
- ✅ Use `const` for immutable variables
- ✅ Use arrow functions `() => {}`
- ✅ Add console logs for debugging
- ✅ Auto-initialize on DOM ready
- ✅ Use event delegation when possible

---

## 🔧 Troubleshooting

### ❌ CSS tidak load
**Solusi:**
```bash
php artisan cache:clear
php artisan config:clear
```

### ❌ JavaScript tidak jalan
**Check:**
1. Apakah Swiper CDN sudah load?
2. Apakah urutan import sudah benar? (landing.js → partials → sections)
3. Check console browser untuk error

### ❌ Swiper tidak muncul
**Check `client.js`:**
```javascript
// Pastikan ada element .clientSwiper
const swiper = new Swiper('.clientSwiper', {
    // Config...
});
```

### ❌ Modal tidak buka
**Check `client-modal.js`:**
```javascript
// Pastikan button punya class .open-modal
// Pastikan modal punya id #clientModal
```

---

## 📝 Adding New Section

### Step 1: Create Blade File
```bash
# resources/views/sections/new-section.blade.php
```

### Step 2: Create CSS File
```bash
# public/css/sections/new-section.css
```

### Step 3: Create JS File
```bash
# public/js/sections/new-section.js
```

### Step 4: Import di Landing Page
```html
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/sections/new-section.css') }}">

<!-- JS -->
<script src="{{ asset('js/sections/new-section.js') }}"></script>
```

### Step 5: Include Section
```blade
@include('sections.new-section')
```

---

## 🎯 Key Features

### ✅ Client Section (Swiper Slider)
- **5 Cards**: KRESYA, TMS POS, TMS PPOB, TASYA, KOCI
- **Centered Start**: Card TASYA di tengah (initialSlide: 2)
- **Size**: 380px width × 450px height
- **Opacity**: 0.3 (far) → 0.7 (adjacent) → 1.0 (active)
- **Autoplay**: 2500ms delay, continuous loop
- **Navigation**: Custom arrows dengan smooth hover
- **Pagination**: Bottom bullets dengan active state

### ✅ FAQ Section
- Accordion dengan single active item
- Smooth expand/collapse animation
- Icon rotation effect

### ✅ Responsive Design
- Mobile-first approach
- Breakpoints: sm (640px), md (768px), lg (1024px), xl (1280px)
- Touch-friendly interactions

---

## 💡 Best Practices

1. **Always use Tailwind first** - Custom CSS hanya untuk animations
2. **Keep sections independent** - Jangan cross-reference antar sections
3. **Test responsive** - Check di mobile, tablet, desktop
4. **Console logs** - Untuk debugging, hapus di production
5. **Git commits** - Commit per feature/fix

---

## 📞 Support

Jika ada masalah atau pertanyaan:
1. Check console browser untuk error
2. Verify import order di `landing_page.blade.php`
3. Clear Laravel cache
4. Check file paths (case-sensitive di Linux)

---

**Last Updated**: 2024
**Version**: 2.0 (Modular Structure)
