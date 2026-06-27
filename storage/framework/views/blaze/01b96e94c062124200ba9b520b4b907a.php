<?php
if (!function_exists('__01b96e94c062124200ba9b520b4b907a')):
function __01b96e94c062124200ba9b520b4b907a($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
extract(Flux::forwardedAttributes($attributes, [
    'name',
    'descriptionTrailing',
    'description',
    'label',
    'badge',
]));
?>

<?php $descriptionTrailing = $descriptionTrailing ??= $attributes->pluck('description:trailing'); ?>

<?php
$__defaults = [
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'descriptionTrailing' => null,
    'description' => null,
    'label' => null,
    'badge' => null,
];
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
$descriptionTrailing ??= $attributes['description-trailing'] ?? $attributes['descriptionTrailing'] ?? $__defaults['descriptionTrailing']; unset($attributes['descriptionTrailing'], $attributes['description-trailing']);
$description ??= $attributes['description'] ?? $__defaults['description']; unset($attributes['description']);
$label ??= $attributes['label'] ?? $__defaults['label']; unset($attributes['label']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
unset($__defaults);
?>

<?php if (isset($label) || isset($description)): ?>
    <?php

        $fieldAttributes = Flux::attributesAfter('field:', $attributes, []);
        $labelAttributes = Flux::attributesAfter('label:', $attributes, ['badge' => $badge]);
        $descriptionAttributes = Flux::attributesAfter('description:', $attributes, []);
        $errorAttributes = Flux::attributesAfter('error:', $attributes, ['name' => $name]);
    ?>
    <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/field.blade.php', $__blaze->compiledPath.'/b6b9bf0c3ad14d5d2ba67f5f5bc3b8b6.php'); ?>
<?php if (isset($__slotsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6)) { $__slotsStackb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6[] = $__slotsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6; } ?>
<?php if (isset($__attrsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6)) { $__attrsStackb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6[] = $__attrsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6; } ?>
<?php $__attrsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6 = ['attributes' => $fieldAttributes]; ?>
<?php $__slotsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6 = []; ?>
<?php $__blaze->pushData($__attrsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6); ?>
<?php ob_start(); ?>
        <?php if (isset($label)): ?>
            <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/label.blade.php', $__blaze->compiledPath.'/bfe730735e536d2d8dc4e9f31cf217d8.php'); ?>
<?php if (isset($__slotsbfe730735e536d2d8dc4e9f31cf217d8)) { $__slotsStackbfe730735e536d2d8dc4e9f31cf217d8[] = $__slotsbfe730735e536d2d8dc4e9f31cf217d8; } ?>
<?php if (isset($__attrsbfe730735e536d2d8dc4e9f31cf217d8)) { $__attrsStackbfe730735e536d2d8dc4e9f31cf217d8[] = $__attrsbfe730735e536d2d8dc4e9f31cf217d8; } ?>
<?php $__attrsbfe730735e536d2d8dc4e9f31cf217d8 = ['attributes' => $labelAttributes]; ?>
<?php $__slotsbfe730735e536d2d8dc4e9f31cf217d8 = []; ?>
<?php $__blaze->pushData($__attrsbfe730735e536d2d8dc4e9f31cf217d8); ?>
<?php ob_start(); ?><?php echo e($label); ?><?php $__slotsbfe730735e536d2d8dc4e9f31cf217d8['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsbfe730735e536d2d8dc4e9f31cf217d8); ?>
<?php __bfe730735e536d2d8dc4e9f31cf217d8($__blaze, $__attrsbfe730735e536d2d8dc4e9f31cf217d8, $__slotsbfe730735e536d2d8dc4e9f31cf217d8, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackbfe730735e536d2d8dc4e9f31cf217d8)) { $__slotsbfe730735e536d2d8dc4e9f31cf217d8 = array_pop($__slotsStackbfe730735e536d2d8dc4e9f31cf217d8); } ?>
<?php if (! empty($__attrsStackbfe730735e536d2d8dc4e9f31cf217d8)) { $__attrsbfe730735e536d2d8dc4e9f31cf217d8 = array_pop($__attrsStackbfe730735e536d2d8dc4e9f31cf217d8); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php if (isset($description)): ?>
            <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/347b907d17cb7e722157cc3a02585624.php'); ?>
<?php if (isset($__slots347b907d17cb7e722157cc3a02585624)) { $__slotsStack347b907d17cb7e722157cc3a02585624[] = $__slots347b907d17cb7e722157cc3a02585624; } ?>
<?php if (isset($__attrs347b907d17cb7e722157cc3a02585624)) { $__attrsStack347b907d17cb7e722157cc3a02585624[] = $__attrs347b907d17cb7e722157cc3a02585624; } ?>
<?php $__attrs347b907d17cb7e722157cc3a02585624 = ['attributes' => $descriptionAttributes]; ?>
<?php $__slots347b907d17cb7e722157cc3a02585624 = []; ?>
<?php $__blaze->pushData($__attrs347b907d17cb7e722157cc3a02585624); ?>
<?php ob_start(); ?><?php echo e($description); ?><?php $__slots347b907d17cb7e722157cc3a02585624['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots347b907d17cb7e722157cc3a02585624); ?>
<?php __347b907d17cb7e722157cc3a02585624($__blaze, $__attrs347b907d17cb7e722157cc3a02585624, $__slots347b907d17cb7e722157cc3a02585624, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack347b907d17cb7e722157cc3a02585624)) { $__slots347b907d17cb7e722157cc3a02585624 = array_pop($__slotsStack347b907d17cb7e722157cc3a02585624); } ?>
<?php if (! empty($__attrsStack347b907d17cb7e722157cc3a02585624)) { $__attrs347b907d17cb7e722157cc3a02585624 = array_pop($__attrsStack347b907d17cb7e722157cc3a02585624); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php echo e($slot); ?>


        
        [STARTCOMPILEDUNBLAZE:gQDx9aYq0O]<?php \Livewire\Blaze\Unblaze::storeScope("gQDx9aYq0O", scope: ['attributes' => $errorAttributes->getAttributes()]) ?>[ENDCOMPILEDUNBLAZE:gQDx9aYq0O]

        <?php if (isset($descriptionTrailing)): ?>
            <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/347b907d17cb7e722157cc3a02585624.php'); ?>
<?php if (isset($__slots347b907d17cb7e722157cc3a02585624)) { $__slotsStack347b907d17cb7e722157cc3a02585624[] = $__slots347b907d17cb7e722157cc3a02585624; } ?>
<?php if (isset($__attrs347b907d17cb7e722157cc3a02585624)) { $__attrsStack347b907d17cb7e722157cc3a02585624[] = $__attrs347b907d17cb7e722157cc3a02585624; } ?>
<?php $__attrs347b907d17cb7e722157cc3a02585624 = ['attributes' => $descriptionAttributes]; ?>
<?php $__slots347b907d17cb7e722157cc3a02585624 = []; ?>
<?php $__blaze->pushData($__attrs347b907d17cb7e722157cc3a02585624); ?>
<?php ob_start(); ?><?php echo e($descriptionTrailing); ?><?php $__slots347b907d17cb7e722157cc3a02585624['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots347b907d17cb7e722157cc3a02585624); ?>
<?php __347b907d17cb7e722157cc3a02585624($__blaze, $__attrs347b907d17cb7e722157cc3a02585624, $__slots347b907d17cb7e722157cc3a02585624, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack347b907d17cb7e722157cc3a02585624)) { $__slots347b907d17cb7e722157cc3a02585624 = array_pop($__slotsStack347b907d17cb7e722157cc3a02585624); } ?>
<?php if (! empty($__attrsStack347b907d17cb7e722157cc3a02585624)) { $__attrs347b907d17cb7e722157cc3a02585624 = array_pop($__attrsStack347b907d17cb7e722157cc3a02585624); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slotsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6); ?>
<?php __b6b9bf0c3ad14d5d2ba67f5f5bc3b8b6($__blaze, $__attrsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6, $__slotsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6)) { $__slotsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6 = array_pop($__slotsStackb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6); } ?>
<?php if (! empty($__attrsStackb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6)) { $__attrsb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6 = array_pop($__attrsStackb6b9bf0c3ad14d5d2ba67f5f5bc3b8b6); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/with-field.blade.php ENDPATH**/ ?>