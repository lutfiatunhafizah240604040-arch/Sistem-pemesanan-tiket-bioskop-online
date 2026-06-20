<?php
if (!function_exists('_708fcff799b79ca105082c33de5555ca')):
function _708fcff799b79ca105082c33de5555ca($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>
<?php $iconTrailing ??= $attributes->pluck('icon:trailing'); ?>
<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'right',
    'tooltipKbd' => null,
    'tooltip' => null,
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'badgeColor' => null,
    'iconDot' => null,
    'accent' => true,
    'badge' => null,
    'icon' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$iconTrailing ??= $attributes['icon-trailing'] ?? $attributes['iconTrailing'] ?? $__defaults['iconTrailing']; unset($attributes['iconTrailing'], $attributes['icon-trailing']);
$badgeColor ??= $attributes['badge-color'] ?? $attributes['badgeColor'] ?? $__defaults['badgeColor']; unset($attributes['badgeColor'], $attributes['badge-color']);
$iconDot ??= $attributes['icon-dot'] ?? $attributes['iconDot'] ?? $__defaults['iconDot']; unset($attributes['iconDot'], $attributes['icon-dot']);
$accent ??= $attributes['accent'] ?? $__defaults['accent']; unset($attributes['accent']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
$icon ??= $attributes['icon'] ?? $__defaults['icon']; unset($attributes['icon']);
unset($__defaults);
?>

<?php
$tooltip ??= $slot->isNotEmpty() ? (string) $slot : null;

// Size-up icons in square/icon-only buttons...
$iconClasses = Flux::classes('size-4')
    ->add('in-data-flux-sidebar-group-dropdown:text-zinc-400! dark:in-data-flux-sidebar-group-dropdown:text-white/80!')
    ->add('[[data-flux-sidebar-item]:hover_&]:text-current!');

$classes = Flux::classes()
    ->add('h-8 in-data-flux-sidebar-on-mobile:h-10 relative flex items-center gap-3 rounded-lg')
    ->add('in-data-flux-sidebar-collapsed-desktop:w-10 in-data-flux-sidebar-collapsed-desktop:justify-center')
    ->add('py-0 text-start w-full px-3 has-data-flux-navlist-badge:not-in-data-flux-sidebar-collapsed-desktop:pe-1.5 my-px')
    ->add('text-zinc-500 dark:text-white/80')
    ->add(match ($accent) {
        true => [
            'data-current:text-(--color-accent-content) hover:data-current:text-(--color-accent-content)',
            'data-current:bg-white dark:data-current:bg-white/[7%] data-current:border data-current:border-zinc-200 dark:data-current:border-transparent',
            'hover:text-zinc-800 dark:hover:text-white dark:hover:bg-white/[7%] hover:bg-zinc-800/5 ',
            'border border-transparent',
        ],
        false => [
            'data-current:text-zinc-800 dark:data-current:text-zinc-100 data-current:border-zinc-200',
            'data-current:bg-white dark:data-current:bg-white/10 data-current:border data-current:border-zinc-200 dark:data-current:border-white/10 data-current:shadow-xs',
            'hover:text-zinc-800 dark:hover:text-white',
        ],
    })
    // Override the default styles to match dropdowns for when the item is inside a collapsed group dropdown...
    ->add('in-data-flux-sidebar-group-dropdown:w-auto! in-data-flux-sidebar-group-dropdown:px-2!')
    ->add('in-data-flux-sidebar-group-dropdown:text-zinc-800! in-data-flux-sidebar-group-dropdown:bg-white! in-data-flux-sidebar-group-dropdown:hover:bg-zinc-50!')
    ->add('dark:in-data-flux-sidebar-group-dropdown:text-white! dark:in-data-flux-sidebar-group-dropdown:bg-transparent! dark:in-data-flux-sidebar-group-dropdown:hover:bg-zinc-600!')
    ;
?>

<?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/ab2d913ce49d98989027f9eafadba5d9.php'); ?>
<?php if (isset($__slotsab2d913ce49d98989027f9eafadba5d9)) { $__slotsStackab2d913ce49d98989027f9eafadba5d9[] = $__slotsab2d913ce49d98989027f9eafadba5d9; } ?>
<?php if (isset($__attrsab2d913ce49d98989027f9eafadba5d9)) { $__attrsStackab2d913ce49d98989027f9eafadba5d9[] = $__attrsab2d913ce49d98989027f9eafadba5d9; } ?>
<?php $__attrsab2d913ce49d98989027f9eafadba5d9 = ['position' => $tooltipPosition]; ?>
<?php $__slotsab2d913ce49d98989027f9eafadba5d9 = []; ?>
<?php $__blaze->pushData($__attrsab2d913ce49d98989027f9eafadba5d9); ?>
<?php ob_start(); ?>
    <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/button-or-link.blade.php', $__blaze->compiledPath.'/a01f2cb6aa0d872d7a02ed7f79ec99f7.php'); ?>
<?php if (isset($__slotsa01f2cb6aa0d872d7a02ed7f79ec99f7)) { $__slotsStacka01f2cb6aa0d872d7a02ed7f79ec99f7[] = $__slotsa01f2cb6aa0d872d7a02ed7f79ec99f7; } ?>
<?php if (isset($__attrsa01f2cb6aa0d872d7a02ed7f79ec99f7)) { $__attrsStacka01f2cb6aa0d872d7a02ed7f79ec99f7[] = $__attrsa01f2cb6aa0d872d7a02ed7f79ec99f7; } ?>
<?php $__attrsa01f2cb6aa0d872d7a02ed7f79ec99f7 = ['attributes' => $attributes->class($classes),'dataFluxSidebarItem' => true]; ?>
<?php $__slotsa01f2cb6aa0d872d7a02ed7f79ec99f7 = []; ?>
<?php $__blaze->pushData($__attrsa01f2cb6aa0d872d7a02ed7f79ec99f7); ?>
<?php ob_start(); ?>
        <?php if ($icon): ?>
            <div class="relative">
                <?php if (is_string($icon) && $icon !== ''): ?>
                    <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $icon, 'variant' => $iconVariant, 'class' => $iconClasses]); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/d03846541e1628de337aa6816c388023.php'); ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses]); ?>
<?php _d03846541e1628de337aa6816c388023($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
                <?php else: ?>
                    <?php echo e($icon); ?>

                <?php endif; ?>

                <?php if ($iconDot): ?>
                    <div class="absolute top-[-2px] end-[-2px]">
                        <div class="size-[6px] rounded-full bg-zinc-500 dark:bg-zinc-400"></div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($slot->isNotEmpty()): ?>
            <div class="
                in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden
                flex-1 text-sm font-medium truncate [[data-nav-footer]_&]:hidden [[data-nav-sidebar]_[data-nav-footer]_&]:block" data-content><?php echo e($slot); ?></div>
        <?php endif; ?>

        <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
            <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $iconTrailing, 'variant' => $iconVariant, 'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!']); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/d03846541e1628de337aa6816c388023.php'); ?>
<?php $__blaze->pushData(['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!']); ?>
<?php _d03846541e1628de337aa6816c388023($__blaze, ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
        <?php elseif ($iconTrailing): ?>
            <?php echo e($iconTrailing); ?>

        <?php endif; ?>

        <?php if (isset($badge) && $badge !== ''): ?>
            <?php $badgeAttributes = Flux::attributesAfter('badge:', $attributes, ['color' => $badgeColor]); ?>
            <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/navlist/badge.blade.php', $__blaze->compiledPath.'/99b040671f2cb304f8d304ce73110965.php'); ?>
<?php if (isset($__slots99b040671f2cb304f8d304ce73110965)) { $__slotsStack99b040671f2cb304f8d304ce73110965[] = $__slots99b040671f2cb304f8d304ce73110965; } ?>
<?php if (isset($__attrs99b040671f2cb304f8d304ce73110965)) { $__attrsStack99b040671f2cb304f8d304ce73110965[] = $__attrs99b040671f2cb304f8d304ce73110965; } ?>
<?php $__attrs99b040671f2cb304f8d304ce73110965 = ['attributes' => $badgeAttributes,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden']; ?>
<?php $__slots99b040671f2cb304f8d304ce73110965 = []; ?>
<?php $__blaze->pushData($__attrs99b040671f2cb304f8d304ce73110965); ?>
<?php ob_start(); ?><?php echo e($badge); ?><?php $__slots99b040671f2cb304f8d304ce73110965['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots99b040671f2cb304f8d304ce73110965); ?>
<?php _99b040671f2cb304f8d304ce73110965($__blaze, $__attrs99b040671f2cb304f8d304ce73110965, $__slots99b040671f2cb304f8d304ce73110965, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack99b040671f2cb304f8d304ce73110965)) { $__slots99b040671f2cb304f8d304ce73110965 = array_pop($__slotsStack99b040671f2cb304f8d304ce73110965); } ?>
<?php if (! empty($__attrsStack99b040671f2cb304f8d304ce73110965)) { $__attrs99b040671f2cb304f8d304ce73110965 = array_pop($__attrsStack99b040671f2cb304f8d304ce73110965); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slotsa01f2cb6aa0d872d7a02ed7f79ec99f7['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsa01f2cb6aa0d872d7a02ed7f79ec99f7); ?>
<?php _a01f2cb6aa0d872d7a02ed7f79ec99f7($__blaze, $__attrsa01f2cb6aa0d872d7a02ed7f79ec99f7, $__slotsa01f2cb6aa0d872d7a02ed7f79ec99f7, ['attributes', 'dataFluxSidebarItem'], ['dataFluxSidebarItem' => 'data-flux-sidebar-item'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacka01f2cb6aa0d872d7a02ed7f79ec99f7)) { $__slotsa01f2cb6aa0d872d7a02ed7f79ec99f7 = array_pop($__slotsStacka01f2cb6aa0d872d7a02ed7f79ec99f7); } ?>
<?php if (! empty($__attrsStacka01f2cb6aa0d872d7a02ed7f79ec99f7)) { $__attrsa01f2cb6aa0d872d7a02ed7f79ec99f7 = array_pop($__attrsStacka01f2cb6aa0d872d7a02ed7f79ec99f7); } ?>
<?php $__blaze->popData(); ?>

    <?php $__blaze->ensureRequired('C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/260410857b5ab7cea44a3e2e2ea4248f.php'); ?>
<?php if (isset($__slots260410857b5ab7cea44a3e2e2ea4248f)) { $__slotsStack260410857b5ab7cea44a3e2e2ea4248f[] = $__slots260410857b5ab7cea44a3e2e2ea4248f; } ?>
<?php if (isset($__attrs260410857b5ab7cea44a3e2e2ea4248f)) { $__attrsStack260410857b5ab7cea44a3e2e2ea4248f[] = $__attrs260410857b5ab7cea44a3e2e2ea4248f; } ?>
<?php $__attrs260410857b5ab7cea44a3e2e2ea4248f = ['kbd' => $tooltipKbd,'class' => 'not-in-data-flux-sidebar-collapsed-desktop:hidden in-data-flux-sidebar-group-dropdown:hidden cursor-default']; ?>
<?php $__slots260410857b5ab7cea44a3e2e2ea4248f = []; ?>
<?php $__blaze->pushData($__attrs260410857b5ab7cea44a3e2e2ea4248f); ?>
<?php ob_start(); ?>
        <?php echo e($tooltip); ?>

    <?php $__slots260410857b5ab7cea44a3e2e2ea4248f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots260410857b5ab7cea44a3e2e2ea4248f); ?>
<?php _260410857b5ab7cea44a3e2e2ea4248f($__blaze, $__attrs260410857b5ab7cea44a3e2e2ea4248f, $__slots260410857b5ab7cea44a3e2e2ea4248f, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack260410857b5ab7cea44a3e2e2ea4248f)) { $__slots260410857b5ab7cea44a3e2e2ea4248f = array_pop($__slotsStack260410857b5ab7cea44a3e2e2ea4248f); } ?>
<?php if (! empty($__attrsStack260410857b5ab7cea44a3e2e2ea4248f)) { $__attrs260410857b5ab7cea44a3e2e2ea4248f = array_pop($__attrsStack260410857b5ab7cea44a3e2e2ea4248f); } ?>
<?php $__blaze->popData(); ?>
<?php $__slotsab2d913ce49d98989027f9eafadba5d9['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsab2d913ce49d98989027f9eafadba5d9); ?>
<?php _ab2d913ce49d98989027f9eafadba5d9($__blaze, $__attrsab2d913ce49d98989027f9eafadba5d9, $__slotsab2d913ce49d98989027f9eafadba5d9, ['position'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackab2d913ce49d98989027f9eafadba5d9)) { $__slotsab2d913ce49d98989027f9eafadba5d9 = array_pop($__slotsStackab2d913ce49d98989027f9eafadba5d9); } ?>
<?php if (! empty($__attrsStackab2d913ce49d98989027f9eafadba5d9)) { $__attrsab2d913ce49d98989027f9eafadba5d9 = array_pop($__attrsStackab2d913ce49d98989027f9eafadba5d9); } ?>
<?php $__blaze->popData(); ?><?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\laragon\www\Sistem-pemesanan-tiket-bioskop-online\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/item.blade.php ENDPATH**/ ?>