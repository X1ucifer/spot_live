<?php $__env->startSection('title', __('Terms & Condition')); ?>
<?php $__env->startSection('content'); ?>
<div class="w-10/12 mx-auto my-10">
    <?php echo $__env->make('layouts.includes.terms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/layouts/pages/terms.blade.php ENDPATH**/ ?>