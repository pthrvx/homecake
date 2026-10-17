<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['href' => null, 'variant' => 'primary']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['href' => null, 'variant' => 'primary']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php $c = 'inline-flex min-h-11 items-center justify-center rounded-full px-6 py-2.5 font-semibold transition '.($variant === 'primary' ? 'bg-terra text-white hover:bg-cocoa' : 'border border-cocoa text-cocoa hover:bg-cocoa hover:text-cream'); ?>
<?php if($href): ?><a href="<?php echo e($href); ?>" <?php echo e($attributes->merge(['class' => $c])); ?>><?php echo e($slot); ?></a>
<?php else: ?><button <?php echo e($attributes->merge(['class' => $c, 'type' => 'submit'])); ?>><?php echo e($slot); ?></button><?php endif; ?>
<?php /**PATH D:\duckhaton\rehomecake\resources\views/components/button.blade.php ENDPATH**/ ?>