<?php $__env->startSection('title', __('Settings')); ?>
<div>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.baseview','data' => ['title' => ''.e(__('Settings')).'']]); ?>
<?php $component->withName('baseview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e(__('Settings')).'']); ?>


        
        <?php if($this->showNotification): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.notification', [])->html();
} elseif ($_instance->childHasBeenRendered('Nh4RDk1')) {
    $componentId = $_instance->getRenderedChildComponentId('Nh4RDk1');
    $componentTag = $_instance->getRenderedChildComponentTagName('Nh4RDk1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Nh4RDk1');
} else {
    $response = \Livewire\Livewire::mount('settings.notification', []);
    $html = $response->html();
    $_instance->logRenderedChild('Nh4RDk1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php elseif($this->showApp): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.web-app-settings', [])->html();
} elseif ($_instance->childHasBeenRendered('R7tyIhg')) {
    $componentId = $_instance->getRenderedChildComponentId('R7tyIhg');
    $componentTag = $_instance->getRenderedChildComponentTagName('R7tyIhg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('R7tyIhg');
} else {
    $response = \Livewire\Livewire::mount('settings.web-app-settings', []);
    $html = $response->html();
    $_instance->logRenderedChild('R7tyIhg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php elseif($this->showPrivacy): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.privacy-policy', [])->html();
} elseif ($_instance->childHasBeenRendered('z0Km2QE')) {
    $componentId = $_instance->getRenderedChildComponentId('z0Km2QE');
    $componentTag = $_instance->getRenderedChildComponentTagName('z0Km2QE');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('z0Km2QE');
} else {
    $response = \Livewire\Livewire::mount('settings.privacy-policy', []);
    $html = $response->html();
    $_instance->logRenderedChild('z0Km2QE', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php elseif($this->showContact): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.contact', [])->html();
} elseif ($_instance->childHasBeenRendered('mifEHVw')) {
    $componentId = $_instance->getRenderedChildComponentId('mifEHVw');
    $componentTag = $_instance->getRenderedChildComponentTagName('mifEHVw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('mifEHVw');
} else {
    $response = \Livewire\Livewire::mount('settings.contact', []);
    $html = $response->html();
    $_instance->logRenderedChild('mifEHVw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php elseif($this->showTerms): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.terms', [])->html();
} elseif ($_instance->childHasBeenRendered('G4LdGxT')) {
    $componentId = $_instance->getRenderedChildComponentId('G4LdGxT');
    $componentTag = $_instance->getRenderedChildComponentTagName('G4LdGxT');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('G4LdGxT');
} else {
    $response = \Livewire\Livewire::mount('settings.terms', []);
    $html = $response->html();
    $_instance->logRenderedChild('G4LdGxT', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php elseif($this->showPageSetting): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.page', [])->html();
} elseif ($_instance->childHasBeenRendered('k3ggDH6')) {
    $componentId = $_instance->getRenderedChildComponentId('k3ggDH6');
    $componentTag = $_instance->getRenderedChildComponentTagName('k3ggDH6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('k3ggDH6');
} else {
    $response = \Livewire\Livewire::mount('settings.page', []);
    $html = $response->html();
    $_instance->logRenderedChild('k3ggDH6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php elseif($this->showCustomNotificationMessage): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.custom-notification-message', [])->html();
} elseif ($_instance->childHasBeenRendered('OlGiNJl')) {
    $componentId = $_instance->getRenderedChildComponentId('OlGiNJl');
    $componentTag = $_instance->getRenderedChildComponentTagName('OlGiNJl');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('OlGiNJl');
} else {
    $response = \Livewire\Livewire::mount('settings.custom-notification-message', []);
    $html = $response->html();
    $_instance->logRenderedChild('OlGiNJl', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php elseif($this->showFileLimits): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('settings.file-limit', [])->html();
} elseif ($_instance->childHasBeenRendered('opJiqn9')) {
    $componentId = $_instance->getRenderedChildComponentId('opJiqn9');
    $componentTag = $_instance->getRenderedChildComponentTagName('opJiqn9');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('opJiqn9');
} else {
    $response = \Livewire\Livewire::mount('settings.file-limit', []);
    $html = $response->html();
    $_instance->logRenderedChild('opJiqn9', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php else: ?>
        <?php echo $__env->make('livewire.settings.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
     <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

</div>
<?php /**PATH /home/spotd2d/domains/client.spotd2d.com/public_html/resources/views/livewire/settings/index.blade.php ENDPATH**/ ?>