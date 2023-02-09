<?php $__env->startSection('title', 'Forgot Password'); ?>
<div wire:init="initiateFireabse">
    <div class="flex items-center min-h-screen p-6 bg-gray-50 ">
        <div class="flex-1 h-full max-w-xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl ">
          
           
            
            <div class="flex items-center justify-center p-6 sm:p-12 ">
                <div class="w-full">
                    
                    <a class="text-lg font-bold text-black dark:text-white"
                        href="<?php echo e(route('login')); ?>">
                        <img src="<?php echo e(setting('websiteLogo',  asset('images/logo.png'))); ?>" class="w-12 h-12 mx-auto rounded"/>
                        <p class="text-center"><?php echo e(setting('websiteName')); ?></p>
                    </a>
                    <h1 class="mt-5 mb-4 text-xl font-semibold text-gray-700"><?php echo e(__('Forgot Password')); ?></h1>

                    <?php if( !$setPassword ): ?>
                        <div
                            x-data="otpForm()"
                            x-init="init()">
                            
                            <form wire:submit.prevent="resetPassword" x-show="!isVerifyOpen()">
                                <?php echo csrf_field(); ?>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input','data' => ['title' => ''.e(__('Phone')).'','placeholder' => '+233--','name' => 'phone']]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Phone')).'','placeholder' => '+233--','name' => 'phone']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                <div x-show="!loading">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.buttons.primary','data' => ['title' => ''.e(__('Reset Password')).'','id' => 'reset-btn']]); ?>
<?php $component->withName('buttons.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Reset Password')).'','id' => 'reset-btn']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                </div>
                                <!-- Add a container for reCaptcha -->
                                <div id="recaptcha-container"></div>
                            </form>

                            
                            <form wire:submit.prevent="verifyOTP" x-show="isVerifyOpen()">
                                <?php echo csrf_field(); ?>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input','data' => ['title' => ''.e(__('Verification Code')).'','type' => 'number','name' => 'otp']]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Verification Code')).'','type' => 'number','name' => 'otp']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                <div x-show="!loading">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.buttons.primary','data' => ['title' => ''.e(__('Verify')).'']]); ?>
<?php $component->withName('buttons.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Verify')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                </div>
                            </form>

                            
                            <div x-show="loading">
                                <img src="<?php echo e(asset('images/loading.svg')); ?>" class="mx-auto my-4" />
                            </div>

                            
                            <p class="my-4 text-xs text-center text-red-500" x-text="errorMessage"></p>


                        </div>
                    <?php else: ?>
                        <form wire:submit.prevent="saveNewPassword">
                            <?php echo csrf_field(); ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input','data' => ['title' => ''.e(__('New Password')).'','type' => 'password','placeholder' => '***************','name' => 'password']]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('New Password')).'','type' => 'password','placeholder' => '***************','name' => 'password']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input','data' => ['title' => ''.e(__('Confirm New Password')).'','type' => 'password','placeholder' => '***************','name' => 'password_confirmation']]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Confirm New Password')).'','type' => 'password','placeholder' => '***************','name' => 'password_confirmation']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                            <div wire:loading.remove>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.buttons.primary','data' => ['title' => ''.e(__('Set New Password')).'']]); ?>
<?php $component->withName('buttons.primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Set New Password')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                            </div>
                            
                            <div class="flex items-center justify-items-center">
                                <img src="<?php echo e(asset('images/loading.svg')); ?>" class="mx-auto my-4" wire:loading wire:target="saveNewPassword"  />
                            </div>
                        </form>
                    <?php endif; ?>


                    
                    <div class="">

                        <p class="flex items-center justify-center mt-4 space-x-2">
                            <span class="font-base"><?php echo e(__('Already have an account?')); ?></span>
                            <a
                                class="text-sm font-medium text-primary-600 hover:underline"
                                href="<?php echo e(route('login')); ?>">
                                <?php echo e(__('Login')); ?>

                            </a>
                        </p>

                    </div>
                </div>
            </div>
          
        </div>
      </div>

    <?php $__env->startPush('scripts'); ?>
        <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>
        <script src="<?php echo e(asset('js/forgot-password.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
</div><?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/livewire/auth/forgot-password.blade.php ENDPATH**/ ?>