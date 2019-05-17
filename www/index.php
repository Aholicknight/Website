<?php
header('X-Frame-Options: DENY');
$page_title = 'Home';
include('includes/head.php');
include('includes/header.php');
?>

<!-- Using a background to place the image here. background-* has better support
and more flexability than object-fit -->
<a id="home-banner" class="banner" href="register.php"></a>

<section class="font-size-zero">
  <div class="col-50 home-section">
    <div class="well">
      The MSI Computer Camps are a set of non-profit summer camps hosted at the University of Regina. The camps are dedicated to the education of youth in the rapidly changing computing industry.
    </div>
    <p>The topics covered over the course of the week long session include:</p>
    <br/>
    <ul>
      <li>Game Development</li>
      <li>Machine Learning</li>
      <li>Web Development</li>
    </ul>
    <p>... and more!</p>
    <br/>
    <p>
      The 2019 Computer Camps will consist of two weeks:<br/>
      Week One: from <strong>July 8th to July 12th</strong><br/>
      Week Two: from <strong>July 15th to July 19th</strong>
    </p>
  </div>
  <div class="col-50 home-section text-center">
    <div id="slider">
      <div class="slider-container">
        <transition-group tag="div" name="slide" class="slider">
          <div v-for="number in [currentNumber]" v-bind:key="number" >
            <img class="slider-image" :src="images[Math.abs(currentNumber) % images.length]"/>
          </div>
        </transition-group>
        <div style="display:none">
          <img :src="images[Math.abs(currentNumber + 1) % images.length]"/>
        </div>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/MT-XP4A-Ktg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
    <br/>
    <p class="social-icons">
      <a class="twitter" href="https://twitter.com/compcamps"><i class="fab fa-3x fa-twitter"></i></a>
      <a class="steam" href="http://steamcommunity.com/groups/msicompcamps"><i class="fab fa-3x fa-steam"></i></a>
      <a class="facebook" href="https://www.facebook.com/compcamps"><i class="fab fa-3x fa-facebook"></i></a>
    </p>
    <br/>
  </div>
</section>

<?php include('includes/footer.php'); ?>
