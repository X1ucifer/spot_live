<?php $__env->startSection('title', __('Wallet Payment Methods') ); ?>
<div>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.baseview','data' => ['title' => ''.e(__('Wallet Payment Methods')).'']]); ?>
<?php $component->withName('baseview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Wallet Payment Methods')).'']); ?>
        <p>
            <span class="font-semibold text-red-500"><?php echo e(__("Note")); ?>:</span>
            <span class="text-sm text-gray-500">
            <?php echo e(__("Any payment method enabled here will show to wallet top-up even if the payment method is deactivated in the payment methods page")); ?>

            </span>
        </p>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('tables.wallet-payment-methods-table', [])->html();
} elseif ($_instance->childHasBeenRendered('yXNjqTb')) {
    $componentId = $_instance->getRenderedChildComponentId('yXNjqTb');
    $componentTag = $_instance->getRenderedChildComponentTagName('yXNjqTb');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('yXNjqTb');
} else {
    $response = \Livewire\Livewire::mount('tables.wallet-payment-methods-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('yXNjqTb', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/livewire/wallet_payment_methods.blade.php ENDPATH**/ ?>