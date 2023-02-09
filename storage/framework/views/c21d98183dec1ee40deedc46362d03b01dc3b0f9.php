<?php $__env->startSection('title', __('Services') ); ?>



<div>
    <form wire:submit.prevent="submit" enctype="multipart/form-data">

        <div>
            <?php if(session()->has('message')): ?>
            <div class="alert alert-success">
                <?php echo e(session('message')); ?>

            </div>
            <?php endif; ?>
        </div>

        
<div class="" style="margin-left: 200px">
    <label for="exampleInputFile">File:</label>
    <input type="file" class="w-full h-20" id="exampleInputFile" wire:model="file">
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <button type="submit" class="bg-black text-white " style="padding: 10px;">
        Save</button>
</div>


</form>

<?php if(App\Http\Livewire\AdsServicesLivewire::view() == null): ?>


    <h1>Services</h1>


<?php else: ?>
    <?php $__currentLoopData = App\Http\Livewire\AdsServicesLivewire::view(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- <h1>http://127.0.0.1:8000/storage/files/<?php echo e($link); ?></h1> -->

<div style="margin:20px; display:flex;">

    <img src=https://client.spotd2d.com/storage/files/<?php echo e($link); ?> alt="Image" width="150" />
    <button style="margin-left:20px; color: red;" onclick="function_delete('<?php echo e($link); ?>')"><a href="/progress/<?php echo e($link); ?>">DELETE</a></button>

</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>




<script>
    function function_delete(data) {
        console.log("-->", data);
        // document.location = "App\Http\Livewire\AdsServicesLivewire::delete(data)";
    }
</script>


<!-- <img src=<?php echo e($img); ?>></img> -->
<!-- <img src="<?php echo e(url('/images/myimage.jpg')); ?>" alt="Image"/> -->

</div>
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/livewire/adsservices.blade.php ENDPATH**/ ?>