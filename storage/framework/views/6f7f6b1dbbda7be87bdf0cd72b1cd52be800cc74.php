<button type="<?php echo e($type ?? 'submit'); ?>"  class="flex items-center justify-center w-full px-4 py-2 <?php echo e(($noMargin ?? false) ? 'mt-0':'mt-4'); ?> text-sm font-medium leading-5 text-center text-white transition-colors duration-150 border border-transparent rounded-lg bg-primary-600 active:bg-primary-600 hover:bg-primary-700 focus:outline-none focus:shadow-outline-primary" wire:click="<?php echo e($wireClick ?? ''); ?>">
    <?php echo e($slot ?? ''); ?>

    <?php echo e($title ?? ''); ?>

</button>
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/components/buttons/primary.blade.php ENDPATH**/ ?>