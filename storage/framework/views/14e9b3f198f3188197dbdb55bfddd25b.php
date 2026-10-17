<?php $__env->startSection('title', 'Galeri'); ?>
<?php $__env->startSection('content'); ?>
<h1 class="font-display text-3xl font-bold">Galeri dokumentasi</h1>
<p class="mt-1 text-sm">Foto produk tampil otomatis di galeri dari data produk. Di sini Anda menambah foto dokumentasi kegiatan.</p>
<form method="POST" action="<?php echo e(route('admin.gallery.store')); ?>" enctype="multipart/form-data" class="mt-6 max-w-xl space-y-4 rounded-2xl border border-cocoa/10 bg-white p-5">
  <?php echo csrf_field(); ?>
  <div>
    <label for="image" class="mb-1 block text-sm font-medium">Foto (jpg/png/webp, maks 2 MB)</label>
    <input id="image" name="image" type="file" required accept="image/jpeg,image/png,image/webp" class="field">
    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-700"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
  <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'caption','label' => 'Keterangan foto (juga dibaca sebagai teks alternatif)','required' => true,'maxlength' => '150']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'caption','label' => 'Keterangan foto (juga dibaca sebagai teks alternatif)','required' => true,'maxlength' => '150']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Unggah foto <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
</form>
<?php if($photos->isEmpty()): ?>
  <p class="mt-8 rounded-2xl bg-white p-6">Belum ada foto dokumentasi.</p>
<?php else: ?>
  <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <figure class="admin-gallery-tile flex h-full flex-col overflow-hidden rounded-2xl border border-cocoa/10 bg-white">
        <img src="<?php echo e($p->image_url); ?>" alt="<?php echo e($p->caption); ?>" class="admin-gallery-image aspect-square w-full object-cover">
        <figcaption class="flex-1 p-3 text-sm"><?php echo e($p->caption); ?>

          <form method="POST" action="<?php echo e(route('admin.gallery.destroy', $p)); ?>" onsubmit="return confirm('Hapus foto ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="mt-2 min-h-11 text-red-700 underline">Hapus</button></form>
        </figcaption>
      </figure>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\duckhaton\rehomecake\resources\views/admin/gallery/index.blade.php ENDPATH**/ ?>