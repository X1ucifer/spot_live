<?php $__env->startSection('title', __('Extensions')); ?>
<div>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.baseview','data' => ['title' => ''.e(__('Extensions')).'','showNew' => ''.e($showDetails).'','actionTitle' => ''.e(__('Install')).'']]); ?>
<?php $component->withName('baseview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Extensions')).'','showNew' => ''.e($showDetails).'','actionTitle' => ''.e(__('Install')).'']); ?>
        <div class="mt-10"></div>
        <?php if($showDetails ?? true): ?>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

                
                <?php $__currentLoopData = $extensions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.settings-item','data' => ['title' => ''.e(__($extension->name)).'','wireClick' => '$emit(\''.e($extension->action).'\')']]); ?>
<?php $component->withName('settings-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__($extension->name)).'','wireClick' => '$emit(\''.e($extension->action).'\')']); ?>
                        <?php echo e(svg($extension->icon ?? 'heroicon-o-puzzle')->class('w-5 h-5 mr-4')); ?>

                     <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        <?php endif; ?>

        <?php $__currentLoopData = $extensions ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount($extension->component,[])->html();
} elseif ($_instance->childHasBeenRendered($extension->id)) {
    $componentId = $_instance->getRenderedChildComponentId($extension->id);
    $componentTag = $_instance->getRenderedChildComponentTagName($extension->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild($extension->id);
} else {
    $response = \Livewire\Livewire::mount($extension->component,[]);
    $html = $response->html();
    $_instance->logRenderedChild($extension->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


     <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>


    
    <div x-data="{ open: <?php if ((object) ('showCreate') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showCreate'->value()); ?>')<?php echo e('showCreate'->hasModifier('defer') ? '.defer' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($_instance->id); ?>').entangle('<?php echo e('showCreate'); ?>')<?php endif; ?> }">
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.modal','data' => ['confirmText' => ''.e(__('Install')).'','action' => 'installExtension']]); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['confirmText' => ''.e(__('Install')).'','action' => 'installExtension']); ?>
            <p class="text-xl font-semibold"><?php echo e(__('Install Extension')); ?></p>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media-upload','data' => ['title' => ''.e(__('Zipped File')).'','name' => 'photo','photo' => $photo,'photoInfo' => $photoInfo,'types' => 'Zip','image' => false,'rules' => '.zip']]); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Zipped File')).'','name' => 'photo','photo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($photo),'photoInfo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($photoInfo),'types' => 'Zip','image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'rules' => '.zip']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    </div>

</div>
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/livewire/extensions/index.blade.php ENDPATH**/ ?>