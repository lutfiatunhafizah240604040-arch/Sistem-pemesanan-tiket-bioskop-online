<?php
if (!function_exists('__6c8ddf20392f6247e652443d1ab23807')):
function __6c8ddf20392f6247e652443d1ab23807($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'tooltipPosition',
    'tooltipKbd',
    'tooltip',
]));
?>

<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'top',
    'tooltipKbd' => null,
    'tooltip' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
unset($__defaults);
?>

<?php if ($tooltip): ?>
    <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/ab2d913ce49d98989027f9eafadba5d9.php'); ?>
<?php if (isset($__slotsab2d913ce49d98989027f9eafadba5d9)) { $__slotsStackab2d913ce49d98989027f9eafadba5d9[] = $__slotsab2d913ce49d98989027f9eafadba5d9; } ?>
<?php if (isset($__attrsab2d913ce49d98989027f9eafadba5d9)) { $__attrsStackab2d913ce49d98989027f9eafadba5d9[] = $__attrsab2d913ce49d98989027f9eafadba5d9; } ?>
<?php $__attrsab2d913ce49d98989027f9eafadba5d9 = ['content' => $tooltip,'position' => $tooltipPosition,'kbd' => $tooltipKbd]; ?>
<?php $__slotsab2d913ce49d98989027f9eafadba5d9 = []; ?>
<?php $__blaze->pushData($__attrsab2d913ce49d98989027f9eafadba5d9); ?>
<?php ob_start(); ?>
        <?php echo e($slot); ?>

    <?php $__slotsab2d913ce49d98989027f9eafadba5d9['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsab2d913ce49d98989027f9eafadba5d9); ?>
<?php __ab2d913ce49d98989027f9eafadba5d9($__blaze, $__attrsab2d913ce49d98989027f9eafadba5d9, $__slotsab2d913ce49d98989027f9eafadba5d9, ['content', 'position', 'kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackab2d913ce49d98989027f9eafadba5d9)) { $__slotsab2d913ce49d98989027f9eafadba5d9 = array_pop($__slotsStackab2d913ce49d98989027f9eafadba5d9); } ?>
<?php if (! empty($__attrsStackab2d913ce49d98989027f9eafadba5d9)) { $__attrsab2d913ce49d98989027f9eafadba5d9 = array_pop($__attrsStackab2d913ce49d98989027f9eafadba5d9); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/with-tooltip.blade.php ENDPATH**/ ?>