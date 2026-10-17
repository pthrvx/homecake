<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('title', 'Kue rumahan untuk acara Anda'); ?> · HomeCake</title>
  <meta name="description" content="<?php echo $__env->yieldContent('desc', 'HomeCake: kue rumahan untuk ulang tahun, arisan, rapat, syukuran, dan acara keluarga.'); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:wght@600;700&display=swap" rel="stylesheet">
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-cream font-sans text-cocoa antialiased">
  <div class="topline"><div class="site-shell flex flex-wrap items-center justify-between gap-2 py-2 text-xs sm:text-sm"><span>🍰 Dibuat dengan cinta, langsung dari dapur kami</span><span>Pesanan acara · Kue fresh · Harga bersahabat</span></div></div>
  <header class="site-header sticky top-0 z-40 border-b border-cocoa/10 bg-cream/95 backdrop-blur-xl">
    <div class="site-shell flex min-h-[76px] flex-wrap items-center justify-between gap-4 py-3">
      <a href="<?php echo e(route('home')); ?>" class="brand-mark"><span class="brand-icon">H</span><span><strong class="font-display text-2xl">HomeCake</strong><small class="block text-[10px] uppercase tracking-[.22em] text-cocoa/60">homemade happiness</small></span></a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="Buka navigasi">☰</button>
      <nav id="main-nav" class="main-nav flex flex-wrap items-center gap-1 text-sm font-semibold">
        <a class="nav-link" href="<?php echo e(route('home')); ?>">Beranda</a><a class="nav-link" href="<?php echo e(route('menu')); ?>">Menu</a><a class="nav-link" href="<?php echo e(route('gallery')); ?>">Galeri</a><a class="nav-link" href="<?php echo e(route('about')); ?>">Cerita Kami</a><a class="nav-link" href="<?php echo e(route('track.form')); ?>">Cek Pesanan</a>
        <a class="button button-primary ml-1" href="<?php echo e(route('order.create')); ?>">Pesan Sekarang <span aria-hidden="true">↗</span></a>
      </nav>
    </div>
  </header>
  <main><?php echo $__env->yieldContent('content'); ?></main>
  <footer id="kontak" class="site-footer mt-20">
    <div class="site-shell grid gap-9 py-12 sm:grid-cols-2 lg:grid-cols-4">
      <div><a href="<?php echo e(route('home')); ?>" class="font-display text-2xl font-bold">HomeCake<span class="text-butter">.</span></a><p class="mt-3 max-w-xs text-sm leading-6 text-white/70">Kue rumahan yang membuat momen sederhana terasa lebih istimewa.</p><div class="mt-4 flex gap-2"><span class="footer-chip">Fresh baked</span><span class="footer-chip">Made with love</span></div></div>
      <div><p class="footer-heading">Jelajahi</p><div class="mt-4 grid gap-3 text-sm text-white/75"><a href="<?php echo e(route('menu')); ?>">Semua menu</a><a href="<?php echo e(route('gallery')); ?>">Galeri kue</a><a href="<?php echo e(route('about')); ?>">Tentang kami</a></div></div>
      <div><p class="footer-heading">Jam operasional</p><p class="mt-4 text-sm leading-6 text-white/75"><?php echo e(config('homecake.hours')); ?></p><p class="mt-2 text-xs text-white/50">Pesanan sebaiknya dilakukan lebih awal.</p></div>
      <div><p class="footer-heading">Hubungi kami</p><p class="mt-4 text-sm leading-6 text-white/75"><?php echo e(config('homecake.address')); ?></p><?php if(config('homecake.wa')): ?><a class="button button-light mt-4" href="https://wa.me/<?php echo e(config('homecake.wa')); ?>">Chat WhatsApp ↗</a><?php endif; ?></div>
    </div><p class="border-t border-white/10 py-4 text-center text-xs text-white/50">© <?php echo e(date('Y')); ?> HomeCake · Dibuat dengan sepenuh hati.</p>
  </footer>
</body></html>
<?php /**PATH D:\duckhaton\rehomecake\resources\views/layouts/app.blade.php ENDPATH**/ ?>