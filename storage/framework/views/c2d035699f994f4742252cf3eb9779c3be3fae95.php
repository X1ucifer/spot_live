<div>
    
    <?php if($showView): ?>
        <div class="flex items-center w-full mb-3 text-2xl font-semibold">
            Driver Location Tracking
            <div class="mx-auto"></div>
            <div
                class="<?php echo e(setting('localeCode') == 'ar' ? 'mr-auto':'ml-auto'); ?>">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.buttons.primary','data' => ['title' => 'Back','wireClick' => 'showExtensions']]); ?>
<?php $component->withName('buttons.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => 'Back','wireClick' => 'showExtensions']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>
        </div>

        <div class="flex items-center mb-4 justify-items-center">
            <div
                class="<?php echo e(setting('localeCode') == 'ar' ? 'mx-auto':''); ?>">
            </div>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.buttons.plain','data' => ['wireClick' => 'showAllDriversOnMap']]); ?>
<?php $component->withName('buttons.plain'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wireClick' => 'showAllDriversOnMap']); ?>
                All
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <div class="w-2"></div>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.buttons.plain','data' => ['wireClick' => 'showOnlineDriversOnMap','bgColor' => 'bg-green-500']]); ?>
<?php $component->withName('buttons.plain'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wireClick' => 'showOnlineDriversOnMap','bgColor' => 'bg-green-500']); ?>
                Online Drivers
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <div class="w-2"></div>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.buttons.plain','data' => ['wireClick' => 'showOfflineDriversOnMap','bgColor' => 'bg-red-500']]); ?>
<?php $component->withName('buttons.plain'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wireClick' => 'showOfflineDriversOnMap','bgColor' => 'bg-red-500']); ?>
                Offline Drivers
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <div class="w-2"></div>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.buttons.plain','data' => ['wireClick' => '$set(\'showCreate\', true)']]); ?>
<?php $component->withName('buttons.plain'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wireClick' => '$set(\'showCreate\', true)']); ?>
                Custom
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <div
                class="<?php echo e(setting('localeCode') == 'ar' ? '':'mx-auto'); ?>">
            </div>
        </div>

        <div class="h-screen w-full">
            <div id="map" class="w-full h-full border rounded-sm border-primary-500" wire:ignore></div>
        </div>

        
        <div x-data="{ open: <?php if ((object) ('showCreate') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showCreate'->value()); ?>')<?php echo e('showCreate'->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showCreate'); ?>')<?php endif; ?> }">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.modal-lg','data' => []]); ?>
<?php $component->withName('modal-lg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                <p class="text-xl font-semibold"><?php echo e(__('Drivers')); ?></p>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('extensions.driver-live-tracking.drivers-table-extension', [])->html();
} elseif ($_instance->childHasBeenRendered('bm8fDxu')) {
    $componentId = $_instance->getRenderedChildComponentId('bm8fDxu');
    $componentTag = $_instance->getRenderedChildComponentTagName('bm8fDxu');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('bm8fDxu');
} else {
    $response = \Livewire\Livewire::mount('extensions.driver-live-tracking.drivers-table-extension', []);
    $html = $response->html();
    $_instance->logRenderedChild('bm8fDxu', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        </div>
    <?php endif; ?>

    
    <?php $__env->startPush('scripts'); ?>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(setting('googleMapKey', '')); ?>&language=<?php echo e(setting('localeCode', 'en')); ?>&libraries=&v=weekly">
        </script>
        
        <script defer src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
        <script defer src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
        <script defer src="https://www.gstatic.com/firebasejs/8.10.0/firebase-firestore.js"></script>
        <script src="<?php echo e(asset('js/extensions/driver_tracking.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

</div>
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/livewire/extensions/driver_live_tracking/index.blade.php ENDPATH**/ ?>