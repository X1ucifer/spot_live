<?php if($showPagination): ?>
    <div class="p-6 md:p-0">
        <?php if($paginationEnabled && $rows->lastPage() > 1): ?>
            <?php echo e($rows->links()); ?>

        <?php else: ?>
            <p class="text-sm text-gray-700 leading-5">
                <?php echo app('translator')->get('Showing'); ?>
                <span class="font-medium"><?php echo e($rows->count()); ?></span>
                <?php echo app('translator')->get('results'); ?>
            </p>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/vendor/livewire-tables/tailwind/includes/pagination.blade.php ENDPATH**/ ?>