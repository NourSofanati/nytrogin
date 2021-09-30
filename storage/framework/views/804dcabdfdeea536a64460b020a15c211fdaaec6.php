<?php $attributes = $attributes->exceptProps(['active']); ?>
<?php foreach (array_filter((['active']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
$classes = ($active ?? false)
            ? 'inline-flex items-center py-6 px-10 text-lg font-bold leading-5 text-[#72559D] focus:outline-none focus:border-indigo-700 transition bg-[#F6F8FC] border-r-[5px] border-[#72559D]'
            : 'inline-flex items-center py-6 px-10 text-lg font-bold leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
?>

<a <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</a>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/vendor/jetstream/components/nav-link.blade.php ENDPATH**/ ?>