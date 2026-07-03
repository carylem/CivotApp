<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <div class="max-w-4xl mx-auto py-6">

        <h1 class="text-2xl font-bold mb-6">
            Liste des projets
        </h1>

        
        <?php if(session('success')): ?>
            <div class="bg-green-200 p-2 mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-200 p-2 mb-4">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border p-4 mb-4 rounded">

                <h2 class="text-xl font-semibold">
                    <?php echo e($project->titre); ?>

                </h2>

                <p class="text-gray-700">
                    <?php echo e($project->description); ?>

                </p>

                <p class="text-sm text-gray-500">
                    Statut : <?php echo e($project->statut); ?>

                </p>

                
                <form method="POST" action="<?php echo e(route('projects.vote', $project)); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="bg-blue-500 text-white px-3 py-1 mt-2 rounded">
                        Voter
                    </button>
                </form>

                
                <form method="POST" action="<?php echo e(route('projects.comment', $project)); ?>" class="mt-3">
                    <?php echo csrf_field(); ?>

                    <textarea
                        name="content"
                        class="w-full border p-2"
                        placeholder="Votre commentaire..."
                        minlength="10"
                        maxlength="500"
                        required
                    ></textarea>

                    <button class="bg-green-500 text-white px-3 py-1 mt-2 rounded">
                        Commenter
                    </button>
                </form>

                
                <div class="mt-4">
                    <h3 class="font-bold">Commentaires</h3>

                    <?php $__currentLoopData = $project->comments()->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border-t py-2">

                            <p><?php echo e($comment->content); ?></p>

                            <small class="text-gray-500">
                                <?php echo e($comment->created_at); ?>

                            </small>

                            <?php if($comment->user_id === auth()->id()): ?>
                                <form method="POST" action="<?php echo e(route('comments.destroy', $comment)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button class="text-red-500 text-sm">
                                        Supprimer
                                    </button>
                                </form>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\ICEA_L2\voting-system\resources\views/projects/index.blade.php ENDPATH**/ ?>