<footer>
  <div class="large-12 columns">
    <div class="row">
      <div class="large-12 columns copyright">
        <p><?='<strong>'.$companyInfo->name.'</strong> '.$config['copyright']?></p>
        <p><strong><?=$language->line('footer_contact')?>:</strong>&nbsp;<a href="mailto:<?=$companyInfo->email?>"><?=$companyInfo->email?></a>&nbsp;(<?=$companyInfo->tlf?>)</p>
        <p>
          <strong><?=$language->line('footer_location')?>:</strong>&nbsp;
          <?=$companyInfo->country?>,&nbsp;
          <?=$companyInfo->city?>&nbsp;
          <?=$companyInfo->state?>&nbsp;-&nbsp;
          <?=$companyInfo->zip_code?>,&nbsp;
          <?=$companyInfo->address?>
        </p>
      </div>
      <hr>
      <div class="large-12 columns">
          <ul class="breadcrumbs">
            <?php foreach ($firstMenuSideBar as $array){ ?>
              <li>
                <a href="<?=$config['domain'].'/content/body/'.str_replace(' ','-',formatString(convert_accented_characters($array['title']),3))?>">
                  <img src="<?=base_url().$array['icon']?>" alt="<?=$array['title']?>" width="24" height="24" >&nbsp;<?=formatString($array['title'])?>
                </a>
              </li>
            <?php } ?>
          </ul>
      </div>
    </div>
  </div>
</footer>

<script src="<?=base_url()?>js/vendor/jquery.min.js"></script>

<script src="<?=base_url()?>js/foundation.min.js"></script>

<script src="<?=base_url()?>js/jquery.form.min.js"></script>

<script src="<?=base_url()?>js/functions.min.js"></script>

<script>
  $(document).foundation();

  <?php if (!empty($index)){ ?>
    showLayer('.bannerTop_box');
  <?php } ?>

  newsletters();

  

</script>

<?php 
  if (isset($jsLibraries) && count($jsLibraries)>0){
    foreach ($jsLibraries as $file){
      if (trim($file)!='' && (file_exists('js/'.$file)||file_exists($file)))
      {
        if (strpos($file, 'ckeditor') !== false)
        {
          echo '<script src="'.base_url().$file.'"></script>';   
        }
        else 
        {
          echo '<script src="'.base_url().'js/'.$file.'"></script>';
        }
      }//file_exists
    }
  }
?>
</body>
</html>