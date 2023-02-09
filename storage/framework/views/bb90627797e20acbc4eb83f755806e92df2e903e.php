<div class="flex items-center p-4 text-lg bg-white border rounded cursor-pointer hover:shadow-md" wire:click='<?php echo e($wireClick ?? ''); ?>' >
    <div class="<?php echo e(isRTL() ? 'ml-4':'mr-4'); ?>"> <?php echo e($slot ?? ''); ?> </div>
    <?php echo e($title); ?>

</div>
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/components/settings-item.blade.php ENDPATH**/ ?>