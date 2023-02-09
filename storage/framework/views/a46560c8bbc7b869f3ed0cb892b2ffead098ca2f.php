<?php $__env->startSection('title', __('Deleted Users') ); ?>
<div>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.baseview','data' => ['title' => ''.e(__('Deleted Users')).'']]); ?>
<?php $component->withName('baseview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Deleted Users')).'']); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('tables.deleted-user-table', [])->html();
} elseif ($_instance->childHasBeenRendered('6VHsuzt')) {
    $componentId = $_instance->getRenderedChildComponentId('6VHsuzt');
    $componentTag = $_instance->getRenderedChildComponentTagName('6VHsuzt');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('6VHsuzt');
} else {
    $response = \Livewire\Livewire::mount('tables.deleted-user-table', []);
    $html = $response->html();
    $_instance->logRenderedChild('6VHsuzt', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/livewire/deleted_users.blade.php ENDPATH**/ ?>