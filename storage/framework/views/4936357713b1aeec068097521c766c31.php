<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['tone' => 'sage']));

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

foreach (array_filter((['tone' => 'sage']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php $c = ['sage' => 'bg-sage', 'butter' => 'bg-butter', 'warn' => 'bg-red-100 text-red-800'][$tone] ?? 'bg-sage'; ?>
<span <?php echo e($attributes->merge(['class' => "rounded-full px-3 py-1 text-xs font-semibold $c"])); ?>><?php echo e($slot); ?></span>
<?php /**PATH D:\duckhaton\rehomecake\resources\views/components/badge.blade.php ENDPATH**/ ?>