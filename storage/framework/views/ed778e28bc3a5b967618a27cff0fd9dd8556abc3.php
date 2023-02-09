<?php $__env->startSection('title', __('Wallet Topup')); ?>
<div class="">
    <div class="w-11/12 p-12 mx-auto mt-20 border rounded shadow md:w-6/12 lg:w-4/12">
        <?php if (isset($component)) { $__componentOriginalcd9972c8156dfa6e5fd36675ca7bf5f21b506e2e = $component; } ?>
<?php $component = $__env->getContainer()->make(BladeUI\Icons\Components\Svg::class, []); ?>
<?php $component->withName('heroicon-o-exclamation'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'w-12 h-12 mx-auto text-yellow-400 md:h-24 md:w-24']); ?>
<?php if (isset($__componentOriginalcd9972c8156dfa6e5fd36675ca7bf5f21b506e2e)): ?>
<?php $component = $__componentOriginalcd9972c8156dfa6e5fd36675ca7bf5f21b506e2e; ?>
<?php unset($__componentOriginalcd9972c8156dfa6e5fd36675ca7bf5f21b506e2e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <p class="text-xl font-medium text-center"><?php echo e(__('Failed')); ?></p>
        <p class="text-sm text-center"><?php echo e($msg ?? ''); ?></p>
    </div>

    
    <p class="w-full p-4 text-sm text-center text-gray-500"><?php echo e(__('You may close this window')); ?></p>
</div>
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/livewire/payment/topup-failed.blade.php ENDPATH**/ ?>