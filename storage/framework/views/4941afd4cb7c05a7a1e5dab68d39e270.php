<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'sidebar' => false,
]));

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

foreach (array_filter(([
    'sidebar' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sidebar): ?>
    <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/brand.blade.php', $__blaze->compiledPath.'/6cad8245e571d2fc29e38ee7cdcfa301.php'); ?>
<?php if (isset($__slots6cad8245e571d2fc29e38ee7cdcfa301)) { $__slotsStack6cad8245e571d2fc29e38ee7cdcfa301[] = $__slots6cad8245e571d2fc29e38ee7cdcfa301; } ?>
<?php if (isset($__attrs6cad8245e571d2fc29e38ee7cdcfa301)) { $__attrsStack6cad8245e571d2fc29e38ee7cdcfa301[] = $__attrs6cad8245e571d2fc29e38ee7cdcfa301; } ?>
<?php $__attrs6cad8245e571d2fc29e38ee7cdcfa301 = ['name' => 'Laravel Starter Kit','attributes' => $attributes]; ?>
<?php $__slots6cad8245e571d2fc29e38ee7cdcfa301 = []; ?>
<?php $__blaze->pushData($__attrs6cad8245e571d2fc29e38ee7cdcfa301); ?>
<?php ob_start(); ?>
             <?php $__slots6cad8245e571d2fc29e38ee7cdcfa301['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php ob_start(); ?>
            <?php if (isset($component)) { $__componentOriginal159d6670770cb479b1921cea6416c26c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal159d6670770cb479b1921cea6416c26c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo-icon','data' => ['class' => 'size-5 fill-current text-white dark:text-black']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 fill-current text-white dark:text-black']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $attributes = $__attributesOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__attributesOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $component = $__componentOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__componentOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
        <?php $__slots6cad8245e571d2fc29e38ee7cdcfa301['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground']); ?>
<?php $__blaze->pushSlots($__slots6cad8245e571d2fc29e38ee7cdcfa301); ?>
<?php _6cad8245e571d2fc29e38ee7cdcfa301($__blaze, $__attrs6cad8245e571d2fc29e38ee7cdcfa301, $__slots6cad8245e571d2fc29e38ee7cdcfa301, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack6cad8245e571d2fc29e38ee7cdcfa301)) { $__slots6cad8245e571d2fc29e38ee7cdcfa301 = array_pop($__slotsStack6cad8245e571d2fc29e38ee7cdcfa301); } ?>
<?php if (! empty($__attrsStack6cad8245e571d2fc29e38ee7cdcfa301)) { $__attrs6cad8245e571d2fc29e38ee7cdcfa301 = array_pop($__attrsStack6cad8245e571d2fc29e38ee7cdcfa301); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/brand.blade.php', $__blaze->compiledPath.'/ff96a3d1b6b56c3b3831b866af6eb05f.php'); ?>
<?php if (isset($__slotsff96a3d1b6b56c3b3831b866af6eb05f)) { $__slotsStackff96a3d1b6b56c3b3831b866af6eb05f[] = $__slotsff96a3d1b6b56c3b3831b866af6eb05f; } ?>
<?php if (isset($__attrsff96a3d1b6b56c3b3831b866af6eb05f)) { $__attrsStackff96a3d1b6b56c3b3831b866af6eb05f[] = $__attrsff96a3d1b6b56c3b3831b866af6eb05f; } ?>
<?php $__attrsff96a3d1b6b56c3b3831b866af6eb05f = ['name' => 'Laravel Starter Kit','attributes' => $attributes]; ?>
<?php $__slotsff96a3d1b6b56c3b3831b866af6eb05f = []; ?>
<?php $__blaze->pushData($__attrsff96a3d1b6b56c3b3831b866af6eb05f); ?>
<?php ob_start(); ?>
             <?php $__slotsff96a3d1b6b56c3b3831b866af6eb05f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php ob_start(); ?>
            <?php if (isset($component)) { $__componentOriginal159d6670770cb479b1921cea6416c26c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal159d6670770cb479b1921cea6416c26c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo-icon','data' => ['class' => 'size-5 fill-current text-white dark:text-black']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 fill-current text-white dark:text-black']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $attributes = $__attributesOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__attributesOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $component = $__componentOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__componentOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
        <?php $__slotsff96a3d1b6b56c3b3831b866af6eb05f['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground']); ?>
<?php $__blaze->pushSlots($__slotsff96a3d1b6b56c3b3831b866af6eb05f); ?>
<?php _ff96a3d1b6b56c3b3831b866af6eb05f($__blaze, $__attrsff96a3d1b6b56c3b3831b866af6eb05f, $__slotsff96a3d1b6b56c3b3831b866af6eb05f, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackff96a3d1b6b56c3b3831b866af6eb05f)) { $__slotsff96a3d1b6b56c3b3831b866af6eb05f = array_pop($__slotsStackff96a3d1b6b56c3b3831b866af6eb05f); } ?>
<?php if (! empty($__attrsStackff96a3d1b6b56c3b3831b866af6eb05f)) { $__attrsff96a3d1b6b56c3b3831b866af6eb05f = array_pop($__attrsStackff96a3d1b6b56c3b3831b866af6eb05f); } ?>
<?php $__blaze->popData(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\resources\views/components/app-logo.blade.php ENDPATH**/ ?>