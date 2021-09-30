<!DOCTYPE html>
<html lang="ar-SA" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>">
    <?php echo \Livewire\Livewire::styles(); ?>


    <!-- Scripts -->
    <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

</head>

<body class="font-sans subpixel-antialiased h-screen flex">
    <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="hidden lg:block bg-[#E5E6E7]" id="sidebar">
        <?php echo $__env->make('navigation-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="max-h-screen w-full bg-[#F6F8FC] overflow-y-auto">


        <!-- Page Heading -->
        <?php if(isset($header)): ?>
            <header class="bg-white border-b-2 border-[#E9EAEB] ">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end">
                        <div class="flex justify-between md:w-auto">
                            <a href="#test" id="show_sidebar" class="lg:hidden">
                                <span class="material-icons text-gray-400 px-4 py-2 my-auto ">
                                    menu
                                </span>
                            </a>
                            <button class="flex text-gray-400  px-4 py-2" onclick="window.history.back();">
                                <p class="ml-4 font-semibold">
                                    الرجوع
                                </p>

                                <span class="material-icons  my-auto">
                                    keyboard_backspace
                                </span>


                            </button>
                        </div>
                    </div>
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <main class="___class_+?17___">
            <?php echo e($slot); ?>

        </main>
    </div>

    <?php echo $__env->yieldPushContent('modals'); ?>

    <?php echo \Livewire\Livewire::scripts(); ?>

    <script src="<?php echo e(asset('js/jquery-3.6.0.min.js')); ?>"></script>
    <script>
        let progress = null;
        $('#search').on('propertychange input', function(e) {
            var valueChanged = false;
            if (e.type == 'propertychange') {
                valueChanged = e.originalEvent.propertyName == 'value';
            } else {
                valueChanged = true;
            }
            if (valueChanged && e.target.value.trim() != '') {
                try {
                    progress.abort();
                } catch {}
                progress = $.ajax({
                    type: "GET",
                    url: "<?php echo e(route('search')); ?>?text=" + e.target.value,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let html = ``;
                        response.forEach(element => {
                            html += `<li><a>
                            ${element.name}
                        </a></li>`;
                        });
                        $('#searchresults').html(html);
                        $('#searchresults').fadeIn();

                    }
                });
            }
        });
        $('#search').focusout(function() {
            try {
                progress.abort();
            } catch (error) {

            }
            $('#searchresults').html(``);
            $('#searchresults').fadeOut();
        });
        $('#show_sidebar').click(function(e) {
            $('#sidebar').fadeIn();
            $('#sidebar').toggleClass('hidden');
        });
        $('#hide_sidebar').click(function(e) {
            $('#sidebar').fadeOut();
        });
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register(window.location.origin + '/sw.js');
        }
    </script>
    <?php echo $__env->yieldContent('footerScripts'); ?>
    <?php echo $__env->yieldContent('footerScripts2'); ?>
    <?php echo $__env->yieldPushContent('custom-scripts'); ?>

</body>



</html>
<?php /**PATH C:\Users\nour\Desktop\Nytrogin\nytrogin\resources\views/layouts/app.blade.php ENDPATH**/ ?>