<!DOCTYPE html>
<html>
  <head>
    <title>
      AJAX Image Upload Demo
    </title>
    <link rel="stylesheet" type="text/css" href="/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="2-theme.css">
    <script src="jquery-3.6.0.min.js"></script>
   <script type="text/javascript" src="jszip-utils.js"></script>
<!--
Mandatory in IE 6, 7, 8 and 9.
-->
<!--[if IE]>
<script type="text/javascript" src="jszip-utils-ie.js"></script>
<![endif]-->
    <script src="jszip.min.js"></script>
    <script src="2-ajax-upload.js"></script>
    <script src="FileSaver.js"></script>
    
    <script src="main.js"></script>
    <link rel="preload" href="/fonts/FuturaPT-Book.ttf" as="font" crossorigin="anonymous" />
    <link rel="preload" href="/fonts/FuturaPT-Medium.ttf" as="font" crossorigin="anonymous" />
  </head>
  <body>
    <main>
      <div class="container">
      	
        <!-- (A) UPLOAD FORM -->
        <form id="upform" class="upform" onsubmit="return ajaxup.add();">
          <label for="upfile" class="uplabel">
            <section class="upblock">
              <figure class="icon">
               <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 308.8 308.8" style="enable-background:new 0 0 308.8 308.8;" xml:space="preserve"><g><path style="fill:#4A566E;" d="M35.6,18.8h180c19.6,0,35.6,16,35.6,35.6v185.2c0,19.6-16,35.6-35.6,35.6h-180C16,275.2,0,259.2,0,239.6V54C0,34.8,16,18.8,35.6,18.8z"/><path style="fill:#00B594;" d="M116.4,186.4l-52.8-52.8L0,197.2v13.2v28.8c0,19.6,16,35.6,35.6,35.6h180c19.6,0,35.6-16,35.6-35.6v-28.8v-39.6l-59.6-60L116.4,186.4z"/><circle style="fill:#FFCC03;" cx="114.8" cy="103.6" r="22.4"/><circle style="fill:#FFFFFF;" cx="251.2" cy="232.4" r="57.6"/></g><g><path style="fill:#00B594;" d="M242.8,205.6c0-4.8,3.6-8.4,8.4-8.4c4.4,0,8.4,3.6,8.4,8.4V260c0,4.8-3.6,8.4-8.4,8.4s-8.4-3.6-8.4-8.4V205.6z"/><path style="fill:#00B594;" d="M245.2,211.2c-3.2-3.2-3.2-8.4,0-11.6s8.4-3.2,11.6,0l19.2,19.2c3.2,3.2,3.2,8.4,0,11.6s-8.4,3.2-11.6,0L245.2,211.2z"/><path style="fill:#00B594;" d="M245.2,199.6c3.2-3.2,8.4-3.2,11.6,0s3.2,8.4,0,11.6L238,230.4c-3.2,3.2-8.4,3.2-11.6,0s-3.2-8.4,0-11.6L245.2,199.6z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
              </figure>
              <p class="upblock__text1">Загрузите ваши WebP файлы сюда!</p>
              <p class="upblock__text2"><small>не более 5 МБ каждый</small></p>
              <input type="file" onchange="document.getElementById('gowebptojpg').click();" class="upfile" accept=".webp" id="upfile" multiple required />
<!--               <input type="file" onchange="document.getElementById('gowebptojpg').click();" class="upfile" accept=".webp, .jpeg, .png, .gif, .bmp" id="upfile" multiple required />
 -->              <span class="btn btn_main">Загрузить</span>
            </section>
          </label>
          <input class="upbutton" id="gowebptojpg" type="submit" value="Конвертировать"/>
        </form>
        <!-- (B) UPLOAD STATUS -->
          <div id="cont-downloadAll"></div>

       <section class="fileslist">
          
          <ul class="fileslist__items"  id="upstat">
            <!--<li class="fileslist__item fileslist__item_process">
              <span class="fileslist__left">
                <span class="fileslist__size">123.5 KB</span>
                <span class="fileslist__name">mapp (2).webp</span>
              </span>
              <div class="progress success">
                <div class="bar" style="width: 100%;"></div>
              </div>
              <span class="fileslist__right">
                <span class="fileslist__resize">78.1 KB</span>
                <a href="#" class="">download</a>
              </span>
            </li>
            <li class="fileslist__item fileslist__item_complete">
              <div class="fileslist__left">
                <span class="fileslist__size">123.5 KB</span>
                <span class="fileslist__name">mapp (2).webp</span>
              </div>
              <div class="progress success">
                <div class="bar" style="width: 100%;"></div>
              </div>
              <div class="fileslist__right">
                <span class="fileslist__resize">78.1 KB</span>
                <a href="#" class="">download</a>
              </div>
            </li>-->
          </ul>
        </section>


        

        <!-- (A) UPLOAD FORM -->
        <form id="upform2" onsubmit="return ajaxup2.add();">
          <h1>JPG в WEBP конвертер</h1>
          <label for="upfile2">Выберите файлы:</label>
          <input type="file" accept=".jpg, .jpeg" id="upfile2" multiple required/>
          <input type="submit" value="Конвертировать"/>
        </form>
         <!--(B) UPLOAD STATUS -->
        <div id="upstat2"></div>
        <hr>
      </div>
    </main>
  </body>
</html>