
<?php if ($state == 'create'): ?>

    <div>An new article is born</div>

    <?php elseif($state == 'edit'): ?>

    <div>An old article has been updated</div>

    <?php else: ?>

    <div>Something went wrong</div>

<?php endif; ?>

