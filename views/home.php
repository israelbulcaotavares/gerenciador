<?php 
$a = new Anuncios(); 
$anuncios = $a->getMeusAnuncios();
?> 
<?php foreach($anuncios as $anuncio): ?>
  <section   class="image3 cid-sxoQ62AvgJ mbr-parallax-background" id="image3-5">
 
  <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(250, 250, 250);">
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8">
        <div class="image-wrapper"> 
         
          <div class="foto_item">
           <a href="<?php echo $anuncio['titulo']; ?>"><img src="assets/images/anuncios/<?php echo $anuncio['url']; ?>" /></a>
          </div>
        

          </div>
        </div>
      </div>
    </div>
  
</section>  
 <?php endforeach; ?>

   

 

  
   

         
       