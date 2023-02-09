<?php $__env->startSection('body'); ?>
<img src="https://sketchvalley.com/wp-content/uploads/2021/02/supportteam-details.jpg" />
<div class="my-8">
    <p class="mb-8 text-3xl font-semibold tracking-wider text-center"><?php echo e(__('Account Updated')); ?></p>
    <p class="mt-1 text-lg font-light"><?php echo e(__('Hi')); ?> <span class="font-bold"><?php echo e($vendor->name); ?></span></p>
    <?php if($vendor->is_active): ?>
        <p class="my-4 text-lg font-light">
            <?php echo e(__("Your account has been activated. You can now manage your account via your manager account.")); ?>

        </p>
        <div class="my-2">
            <p>
                <?php echo e(__("Here's where you can login to")); ?> <?php echo e(env('APP_NAME','')); ?> <?php echo e(__("(be sure to bookmark this page).")); ?>

            </p>
            <p>
                <a href="<?php echo e(route('login')); ?>" class="text-blue-900 underline"><?php echo e(route('login')); ?></a>
            </p>
        </div>
    <?php else: ?>
        <p class="my-4 text-lg font-light">
            <?php echo e(__("Your account has just been deactivated. You will not be able to accept order from customers.")); ?>

            <?php if($vendor->use_subscription): ?>
            <?php echo e(__("This can be caused by an expired subscription. You would need to login and subscribe to a Subscription plan for your account be be activated again.")); ?>

            <?php endif; ?>
        </p>
        <div class="my-2">
            <p>
                <?php echo e(__("Here's where you can contact support for more info")); ?> 
            </p>
            <p>
                <a href="<?php echo e(route('contact')); ?>" class="text-blue-900 underline"><?php echo e(route('contact')); ?></a>
            </p>
        </div>
    <?php endif; ?>



</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('view.emails.plain', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/view/emails/vendor_update.blade.php ENDPATH**/ ?>