<?php if ($pager->hasPrevious()) : ?>
    <a href="<?= $pager->getFirstPage() ?>" class="px-3 py-2 bg-gray-200 text-gray-800 rounded">First</a>
    <a href="<?= $pager->getPreviousPage() ?>" class="px-3 py-2 bg-gray-200 text-gray-800 rounded">Prev</a>
<?php endif; ?>


<?php foreach ($pager->links() as $link) : ?>
    <a href="<?= $link['uri'] ?>"
        class="px-3 py-2 <?= $link['active'] ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' ?> rounded">
        <?= $link['title'] ?>
    </a>
<?php endforeach; ?>

<?php if ($pager->hasNext()) : ?>
    <a href="<?= $pager->getNextPage() ?>" class="px-3 py-2 bg-gray-200 text-gray-800 rounded">Next</a>
    <a href="<?= $pager->getLastPage() ?>" class="px-3 py-2 bg-gray-200 text-gray-800 rounded">Last</a>
<?php endif; ?>

