<?php $this->extend('admin/template/main'); ?>

<?php $this->section('content'); ?>

<h1>Nextcloud File List</h1>

<ul>
          <?php foreach ($files as $file) : ?>
          <li>
                    <?= $file['href'] ?>
                    (<?= $file['{DAV:}getcontenttype'] ?>)
                    <?= $file['{DAV:}getlastmodified'] ?>
                    <a href="<?= site_url('nextcloud/download/' . $file['href']) ?>">Download</a>
                    <a href="<?= site_url('nextcloud/delete/' . $file['href']) ?>">Delete</a>
          </li>
          <?php endforeach ?>
</ul>

<form action="<?= site_url('nextcloud/upload') ?>" method="post" enctype="multipart/form-data">
          <input type="file" name="file">
          <button type="submit">Upload</button>
</form>

<?php $this->endSection(); ?>