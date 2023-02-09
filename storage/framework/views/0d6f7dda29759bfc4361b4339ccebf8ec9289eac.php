<?php $__env->startSection('title', __('Refunds')); ?>
<div>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.baseview','data' => ['title' => ''.e(__('Refunds')).'']]); ?>
<?php $component->withName('baseview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Refunds')).'']); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('tables.refund-table', [])->html();
} elseif ($_instance->childHasBeenRendered('mqPo3Pf')) {
    $componentId = $_instance->getRenderedChildComponentId('mqPo3Pf');
    $componentTag = $_instance->getRenderedChildComponentTagName('mqPo3Pf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('mqPo3Pf');
} else {
    $response = \Livewire\Livewire::mount('tables.refund-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('mqPo3Pf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
     <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

    
    <div x-data="{ open: <?php if ((object) ('showDetails') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showDetails'->value()); ?>')<?php echo e('showDetails'->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showDetails'); ?>')<?php endif; ?> }">
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.modal-lg','data' => []]); ?>
<?php $component->withName('modal-lg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
            <p class="text-xl font-semibold"><?php echo e(__('Order Details')); ?></p>
            <?php if(!empty($selectedModel) ): ?>
                <?php switch($selectedModel->order_type):
                    case ("package"): ?>
                        <?php echo $__env->make('livewire.order.package_order_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php break; ?>
                    <?php case ("parcel"): ?>
                        <?php echo $__env->make('livewire.order.package_order_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php break; ?>
                    <?php case ("service"): ?>
                        <?php echo $__env->make('livewire.order.service_order_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php break; ?>
                    <?php case ("taxi"): ?>
                        <?php echo $__env->make('livewire.order.taxi_order_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php break; ?>

                    <?php default: ?>
                        <?php echo $__env->make('livewire.order.regular_order_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php break; ?>
                <?php endswitch; ?>
            <?php endif; ?>
         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    </div>


</div>
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/livewire/refunds.blade.php ENDPATH**/ ?>