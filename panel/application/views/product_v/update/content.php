<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <b><?php echo $item->title ?></b> kaydını düzenliyorsunuz...
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <form action="<?php echo base_url("product/update/".$item->id) ?>" method="post">
      <div class="form-group">
        <label>Başlık</label>
        <input class="form-control" placeholder="Başlık" name = 'title' value="<?php echo $item->title ?>">
        <?php if (isset($form_error)){ ?>
          <small class="pull-right input-form-error"><?php echo form_error('title'); ?></small>
        <?php } ?>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Açıklama</label>
        <textarea name = "description" class="m-0" data-plugin="summernote" data-options="{height: 250}">
          <?php echo $item->description; ?>
        </textarea>
      </div>

      <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
      <a class="btn btn-md btn-danger btn-outline" href="<?php echo base_url('product'); ?>">İptal</a>
    </form>
    </div><!-- .widget -->
  </div><!-- END column -->
